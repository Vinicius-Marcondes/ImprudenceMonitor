/*-----------------------------------------------------------------------
  CREATE DATABASE MDI;
  CREATE TABLE MDI.REGISTRO (
  ID INTEGER PRIMARY KEY AUTO_INCREMENT,
  ID_ARDUINO INT NOT NULL,
  FUNCIONARIO CHAR(40),
  CONT INT,
  VALOR_X FLOAT,
  VALOR_Y FLOAT,
  RECORDED TIMESTAMP
  );
  -------------------------------------------------------------------------*/
#include <SPI.h>
#include <Wire.h>
#include <EEPROM.h>
#include <Ethernet.h>
#include <LiquidCrystal.h>
#include <SparkFun_MMA8452Q.h>

#define green A1
#define red A0
#define port 80
#define pinoutput 3
#define ID_ARDUINO  1

MMA8452Q accel;

EthernetClient client;
LiquidCrystal lcd(4, 5, 6, 7, 8, 9);
IPAddress ip(192, 168, 100, 68); //ip do arduino
IPAddress server(192, 168, 1, 100); //ip da internet

char X[6];
char Y[6];
int CONT;
String userId;
bool net;
char URL[64];
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};

void setup() {

  pinMode(pinoutput, OUTPUT);
  analogWrite(pinoutput, 98);
  pinMode(green, OUTPUT);
  digitalWrite(green, 0);
  pinMode(red, OUTPUT);
  digitalWrite(red, 1);

  Serial.begin(9600);
  lcd.begin(16, 2);
  lcd.print("Initializing");

  accel.init(SCALE_8G, ODR_6);
  Ethernet.begin(mac, ip);

  conn();
  client.print("Connection: close");
  client.stop();

  Serial.println("Status ethernet:");
  Serial.print(net);
  Serial.println("GETTING USERID AND CONT");

  getUserId();
  Serial.print("user: ");
  Serial.println(userId);

  getCont();
  printLCD();

  digitalWrite(red, 0);
  digitalWrite(green, 1);
}

void loop() {
  accel.read();
  printCalculatedAccels();
  if (accel.cx > 1) {
    digitalWrite(green, 0);
    tone(2, 440);
    digitalWrite(red, 1);
    delay(500);
    noTone(2);
    analogWrite(pinoutput, 98);
    CONT++;
    printLCD();
    dtostrf(accel.cx, 1, 2, X);
    dtostrf(accel.cy, 1, 2, Y);
    sendData(X, Y, CONT);
    delay(5000);
    digitalWrite(red, 0);
    digitalWrite(green, 1);
  }
  Serial.println();
}

//void printEeprom() {
//  EEPROM.put(0, userData);
//}
//
//void readEeprom() {
//  EEPROM.get(0, userData);
//}

bool conn() {
  while (!client.connect(server, port));
  net = true;
}

bool sendData(char X[6], char Y[6], int CONT) {

  sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
  Serial.println(URL);
  if (conn()) {
    client.println(URL);
    client.print("Connection: close");
    client.stop();
  }
}

void getUserId() {
  if (conn()) {
    sprintf(URL, "GET /userID.php?ID_ARDUINO=%d", ID_ARDUINO);
    client.println(URL);
    client.println("Connection: close");
    client.println();
    delay(500);
    while (client.available()) {
      char c = client.read();
      userId = userId + c;
    }
    client.stop();
  }
}

void getCont() {
  if (conn()) {
    sprintf(URL, "GET /cont.php?ID_ARDUINO=%d", ID_ARDUINO);
    client.println(URL);
    delay(500);
    String cont;
    while (client.available()) {
      char c = client.read();
      cont = cont + c;
    }
    CONT = cont.toInt();
    client.println("Connection: close");
    client.stop();
  }
}

void printCalculatedAccels() {
  Serial.print(accel.cx);
  Serial.print("\t");
  Serial.print(accel.cy);
  Serial.print("\t");
}

void printLCD() {
  lcd.clear();
  lcd.setCursor(13, 0);
  lcd.print("E=");
  lcd.setCursor(15, 0);
  lcd.print(net);
  lcd.setCursor(0, 0);
  lcd.print("User ID: ");
  lcd.setCursor(8, 0);
  lcd.print(userId);
  lcd.setCursor(0, 1);
  lcd.print("Delitos: ");
  lcd.setCursor(8, 1);
  lcd.print(CONT);
}



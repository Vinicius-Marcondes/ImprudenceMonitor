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
LiquidCrystal lcd(4, 5, 9, 8, 7, 6);
IPAddress ip(192, 168, 100, 149); //ip do arduino
IPAddress server(191, 232, 196, 80); //ip da internet

struct userObj {
  int CONT;
  char X[6];
  char Y[6];
  String userId;
};
char URL[64];
bool net;
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};

userObj userData = {
  8,
  "1.25",
  "-0.5",
  "1"
};

void setup() {
  pinMode(pinoutput, OUTPUT);
  analogWrite(pinoutput, 98);
  pinMode(green, OUTPUT);
  digitalWrite(green, 1);
  pinMode(red, OUTPUT);
  digitalWrite(red, 0);  

  Serial.begin(9600);
  lcd.begin(16, 2);

  accel.init(SCALE_8G, ODR_6);
  Ethernet.begin(mac, ip);

  conn();
  client.print("Connection: close");
  client.stop();

  lcd.print("Initializing");

  Serial.println("GETTING USERID AND CONT");
  Serial.println(net);
  //printEeprom();
  readEeprom();
  sendData(userData.X, userData.Y, userData.CONT);
  getCont();
  getUserId();
  printLCD();
  delay(1000);
}

void loop() {
  accel.read();
  printCalculatedAccels();
  if (accel.cx > 1) {
    digitalWrite(green,0);
    tone(2, 440);
    digitalWrite(red,1);
    delay(500);
    noTone(2);
    userData.CONT++;
    printLCD();
    dtostrf(accel.cx, 1, 2, userData.X);
    dtostrf(accel.cy, 1, 2, userData.Y);
    sendData(userData.X, userData.Y, userData.CONT);
    digitalWrite(red,0);
    delay(5000);
    digitalWrite(green,1);
  }
  Serial.println();
}

void printEeprom() {
  EEPROM.put(0, userData);
}

void readEeprom() {
  EEPROM.get(0, userData);
}

bool conn() {
  if (client.connect(server, port)) {
    net = true;
    return true;
  }
  else {
    net = false;
    return false;
  }
}

bool sendData(char X[6], char Y[6], int CONT) {
  sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
  Serial.println(URL);
  if (conn()) {
    client.println(URL);
    client.print("Connection: close");
    client.stop();
    return true;
  }
  else {
    printEeprom();
    delay(500);
    Serial.print("\nEEPROM: ");
    readEeprom();
    Serial.println(userData.CONT);
    Serial.println(userData.userId);
    Serial.println(userData.X);
    Serial.println(userData.Y);
    return false;
  }
}

void getUserId() {
  if (conn()) {
    String userid;
    sprintf(URL, "GET /userID.php?ID_ARDUINO=%d", ID_ARDUINO);
    client.println(URL);
    client.println("Connection: close");
    client.println();
    delay(500);
    while (client.available()) {
      char c = client.read();
      userid = userid + c;
    }
    client.stop();
    userData.userId = userid;
  }
  else {
    //readEeprom();
  }
}

int getCont() {
  if (conn()) {
    sprintf(URL, "GET /cont.php?ID_ARDUINO=%d", ID_ARDUINO);
    client.println(URL);
    delay(500);
    String cont;
    int CONT;
    while (client.available()) {
      char c = client.read();
      cont = cont + c;
    }
    CONT = cont.toInt();
    Serial.println(CONT);
    client.println("Connection: close");
    client.stop();
    userData.CONT = CONT;
  }
  else {
    //readEeprom();
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
  lcd.print(userData.userId);
  lcd.setCursor(0, 1);
  lcd.print("Delitos: ");
  lcd.setCursor(8, 1);
  lcd.print(userData.CONT);
}


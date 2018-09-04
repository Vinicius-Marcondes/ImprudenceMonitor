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
#include <Ethernet.h>
#include <LiquidCrystal.h>
#include <SparkFun_MMA8452Q.h>

#define port 80
#define pinoutput 3
#define SS_SD_CARD 4
#define ID_ARDUINO  1

MMA8452Q accel;

EthernetClient client;
LiquidCrystal lcd(4, 5, 9, 8, 7, 6);
IPAddress ip(0,0,0,0); //ip do arduino
IPAddress server(191,232,196,80); //ip da internet


byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char URL[64];
int CONT;
char X[8];
char Y[8];
String userid;

void setup() {
  pinMode(pinoutput, OUTPUT);
  analogWrite(pinoutput, 100);

  Serial.begin(9600);
  lcd.begin(16, 2);

  Serial.println("aaaah");
  while(!client.connect(server,port));
  Serial.println("eeee");
  
  accel.init(SCALE_8G, ODR_6);
  Ethernet.begin(mac, ip);

  lcd.print("Initializing");

  Serial.println("GETTING USERID AND CONT");
  getId();
  getCont();
  printLCD();
  Serial.println(userid);
  Serial.println(CONT);
  delay(1000);
}

bool conn() {
  if (client.connect(server, port)) {
    return true;
  }
  else {
    return false;
  }
}

void getId() {
  if (conn()) {
    sprintf(URL, "GET /userID.php?ID_ARDUINO=%d", ID_ARDUINO);
    client.println(URL);
    client.println("Connection: close");
    client.println();
  } else {
    getId();
  }
  delay(2000);
  while (client.available()) {
    char c = client.read();
    userid = userid + c;
  }
  client.stop();
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
    Serial.println(CONT);
    client.println("Connection: close");
    client.stop();
  }
  else {
    getCont();
  }
}

void printCalculatedAccels() {
  Serial.print(accel.cx);
  Serial.print("\t");
  Serial.print(accel.cy);
  Serial.print("\t");
}

void printLCD() {
  //lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("User ID: ");
  lcd.setCursor(8, 0);
  lcd.print(userid);
  lcd.setCursor(0, 1);
  lcd.print("Delitos: ");
  lcd.setCursor(8, 1);
  lcd.print(CONT);
}

bool sendData(String var) {
  Serial.println(var);
  if (conn() == true) {
    if (client.println(var)) {
      client.print("Connection: close");
      client.stop();
      return true;
    }
    else {
      sendData(var);
    }
  }
  else {
    sendData(var);
  }
}

void loop() {
  accel.read();
  printCalculatedAccels();
  if (accel.cx > 1) {
    tone(2, 440);
    delay(500);
    noTone(2);
    CONT++;
    printLCD();
    dtostrf(accel.cx, 1, 2, X);
    dtostrf(accel.cy, 1, 2, Y);
    sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
    sendData(URL);
    delay(5000);
  }
  Serial.println();
}
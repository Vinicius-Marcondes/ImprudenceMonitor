#include <SD.h>
#include <SPI.h>
#include <Wire.h>
#include <Ethernet.h>
#include <LiquidCrystal.h>
#include <SparkFun_MMA8452Q.h>
#define pinoutput 3
MMA8452Q accel;
File myFile;
IPAddress server(191, 232, 196, 80); //ip da internet
IPAddress ip(192, 168, 100, 60); //ip do arduino
EthernetClient client;
LiquidCrystal lcd(4, 5, 6, 7, 8, 9);

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char URL[64];
int CONT;
int ID_ARDUINO = 1;
char X[8];
char Y[8];
String userid;

void setup() {
  pinMode(pinoutput, OUTPUT);
  analogWrite(pinoutput, 10);
  
  Serial.begin(9600);
  lcd.begin(16, 2);  
  //while (!SD.begin(4));
  accel.init(SCALE_8G, ODR_6);
  Ethernet.begin(mac, ip);
  
  lcd.print("Initializing"); 
  
  delay(1000);
  
  getData();
  printLCD();
  Serial.print("User ID:\t");
  Serial.print(userid);
}

bool conn() {
  if (client.connect(server, 80)) {
    return true;
  }
  else {
    return false;
  }
}

String getData() {
  if (conn()) {
    sprintf(URL,"GET /userID.php?ID_ARDUINO=%d",ID_ARDUINO);
    client.println(URL);   
    client.println("Connection: close");
    client.println();
  } else {
    getData();
  }
  delay(2000);
  while (client.available()) {
    char c = client.read(); 
    userid = userid + c;
  }
  client.stop();
  if (conn()) {
    sprintf(URL,"GET /cont.php?ID_ARDUINO=%d",ID_ARDUINO);
    client.println(URL); 
    client.println("Connection: close");
    client.println();
  } else {
    getData();
  }
  Serial.print("CONT:\t");
  while(client.available()){
    char c = client.read();
    Serial.print(c);
  }
  //Serial.print(CONT); 
  delay(20000);
  client.stop();
  return userid;
}

void escrever(char var[64]) {
  SD.remove("log.txt");
  myFile = SD.open("log.txt", FILE_WRITE);
  if (myFile) {
    myFile.print(var);
    myFile.close();
    Serial.println("done.");
  }
  else {
    Serial.println("error gravar");
  }
}
void ler() {
  myFile = SD.open("log.txt");
  if (myFile) {
    char buff[128];
    Serial.println("log.txt:");
    //conn();
    while (myFile.available()) {
      myFile.read(buff, 128);
    }
    Serial.println("-------------");
    Serial.println(buff);
    Serial.println("-------------");
    delay(5000);
    myFile.close();
  }
  else {
    Serial.println("error ler");
  }
}

bool sendData(char var[64]) {
  Serial.println(var);
  if (conn() == true) {
    if (client.println(var)) {
      client.print("Connection: close");
      client.stop();
      return true;
    }
    else {
      return false;
    }
  }
  else {
    return false;
  }
}

void printCalculatedAccels() {
  Serial.print(accel.cx);
  Serial.print("\t");
  Serial.print(accel.cy);
  Serial.print("\t");
}

void printLCD() {
  lcd.setCursor(0, 0);
  lcd.print("User ID: ");
  lcd.setCursor(8, 0);
  lcd.print(userid);
  lcd.setCursor(0, 1);
  lcd.print("Delitos: ");
  lcd.setCursor(8, 1);
  lcd.print(CONT);
}

void loop() {
  accel.read();
  printCalculatedAccels();
  printLCD();
  if (accel.cx > 1) {
    tone(2, 440);
    delay(500);
    noTone(2);
    conn();
    dtostrf(accel.cx, 1, 2, X);
    dtostrf(accel.cy, 1, 2, Y);
    sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
    client.println(URL);
    Serial.println(URL);
    client.print("Connection: close");
    client.stop();
    //escrever(URL);
    //ler();
    printLCD();
    delay(5000);
  }
  Serial.println();
}


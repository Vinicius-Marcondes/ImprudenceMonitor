#include <SD.h>
#include <SPI.h>
#include <Wire.h>
#include <Ethernet.h>
//#include <LiquidCrystal.h>
#include <SparkFun_MMA8452Q.h>
#define pinoutput 3
#define port 80
#define ID_ARDUINO  1

MMA8452Q accel;
File myFile;
IPAddress server(191, 232, 196, 80); //ip da internet
IPAddress ip(192, 168, 100, 60); //ip do arduino
EthernetClient client;
//LiquidCrystal lcd(4, 5, 6, 7, 8, 9);

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char URL[64];
int CONT;
char X[8];
char Y[8];
String userid;

void setup() {
  //pinMode(pinoutput, OUTPUT);
  //analogWrite(pinoutput, 10);

  Serial.begin(9600);
  //lcd.begin(16, 2);
  Serial.println("SD INITIALIZING");
  while(!SD.begin(4)){
    Serial.println("Failed");
  }
  accel.init(SCALE_8G, ODR_6);
  Ethernet.begin(mac, ip);

  //lcd.print("Initializing");

  delay(100);
  Serial.println("GETTING USERID AND CONT");
  getId();
  getCont();
  //printLCD();
  Serial.println(userid);
  Serial.println(CONT);
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

void printCalculatedAccels() {
  Serial.print(accel.cx);
  Serial.print("\t");
  Serial.print(accel.cy);
  Serial.print("\t");
}

/*void printLCD() {
  lcd.setCursor(0, 0);
  lcd.print("User ID: ");
  lcd.setCursor(8, 0);
  lcd.print(userid);
  lcd.setCursor(0, 1);
  lcd.print("Delitos: ");
  lcd.setCursor(8, 1);
  lcd.print(CONT);
}*/

bool sendData(char var[64]) {
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
  //printLCD();
  if (accel.cx > 1) {
    tone(2, 440);
    delay(500);
    noTone(2);
    CONT++;
    dtostrf(accel.cx, 1, 2, X);
    dtostrf(accel.cy, 1, 2, Y);
    sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
    sendData(URL);
    escrever(URL);
    ler();
    //printLCD();
    delay(5000);
  }
  Serial.println();
}



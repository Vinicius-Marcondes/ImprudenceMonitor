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
#include <Ethernet.h>
#include <Wire.h>
#include <SparkFun_MMA8452Q.h>
#include <LiquidCrystal.h>

LiquidCrystal lcd(4,5,6,7,8,9);
MMA8452Q accel;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };//mac do arduino
char ID [64];
char URL[128];
char NOME[128];
char X[16];
char Y[16];
char c;//infrações
char i;//lê os valores do nome do funcionário
int CONT;
int ID_ARDUINO = 1;
int t = 0;
float f;
float b;
float delta;
String string;//Armazena o nome completo do funcionário
IPAddress server(191,239,252,98); //ip da internet
IPAddress ip(192,168,100,60); //ip do arduino
EthernetClient client;

void setup() {
  Serial.begin(9600);
  lcd.begin(16, 2);
  lcd.setCursor(0,0);
  lcd.print("Initializing...");  
  Ethernet.begin(mac, ip);
  delay(5000);
  accel.init();
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Connecting...");
  while (!client.connect(server, 8080));
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Connected");
  delay(1000);
  lcd.clear();
  lcd.print("Fetching data...");
  sprintf(ID, "GET /cont.php?ID_ARDUINO=%d", ID_ARDUINO);
  client.println(ID);
  delay(2000);
  c = client.read();//recebe numero de infrações
  CONT = c - 48;//converte c em inteiro;
  client.println("Connection: close");
  client.stop();  
  while (!client.connect(server, 8080));
  sprintf(NOME, "GET /nome.php?ID_ARDUINO=%d", ID_ARDUINO);
  client.println(NOME);
  delay(500);
  while(client.available()){//loop para pegar o id do funcionário
    i = client.read();
    string = string+i;
    client.println("Connection: keep-alive");
  }//fecha o loop
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("User ID: ");
  lcd.setCursor(8,0);
  lcd.print(string);
  lcd.setCursor(0,1);
  lcd.print("Delitos:");
  lcd.setCursor(8,1);
  lcd.print(CONT);
  Serial.print(CONT);
  client.println("Connection: close");
  client.stop();  
}

void loop() {
  if (accel.available()) {
    accel.read();
    printCalculatedAccels();
    Serial.println();
    if (t == 0) {
      f = accel.cy;
      t = 1;
    } else {
      b = accel.cy;
      t = 0;
    }
    delta = (b - f);
    if (accel.cx > 1 || delta > 0.7 || delta < -0.7|| accel.cy >1 || accel.cy <-1) {
      while (!client.connect(server, 8080));
      float VALOR_X = accel.cx;
      float VALOR_Y = accel.cy;
      CONT++;
      Serial.println("INFRACAO");
      lcd.setCursor(0,1);
      lcd.print("Delitos:");
      lcd.setCursor(8,1);
      lcd.print(CONT);
      dtostrf(VALOR_X, 1, 2, X);
      dtostrf(VALOR_Y, 1, 2, Y);
      sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
      client.println(URL);//ENVIA A URL USANDO GET
      Serial.println("URL enviada: ");
      Serial.println(URL);
      accel.cx = 0;
      accel.cy = 0;
      tone (3,440);
      delay(500);
      noTone(3);
      delay(200);
      client.println("Connection: close");
      client.stop();
      delay(500);
      delta = 0;
      f=0;
      b=0;
    }
  }
}

void printCalculatedAccels() {
  Serial.print(accel.cx, 3);
  Serial.print('\t');
  Serial.print(accel.cy, 3);
  Serial.print('\t');
}


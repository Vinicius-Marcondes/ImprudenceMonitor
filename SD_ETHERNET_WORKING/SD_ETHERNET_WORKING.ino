#include <SPI.h>
#include <SD.h>
#include <Wire.h>
#include <Ethernet.h>
#include <SparkFun_MMA8452Q.h>
#define port 80
#define ID_ARDUINO  1

MMA8452Q accel;
File myFile;

IPAddress server(191, 232, 196, 80); //ip da internet
IPAddress ip(192, 168, 100, 60); //ip do arduino
EthernetClient client;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char URL[64];
int CONT = 9;
char X[8];
char Y[8];

void setup() {
  accel.init(SCALE_8G, ODR_6);
  Serial.begin(9600);
  while (!Serial);
  Ethernet.begin(mac, ip);
  Serial.print("Initializing SD card...");
  if (!SD.begin(4)) {
    Serial.println("initialization failed!");
  }
  Serial.println("initialization done.");
}

bool conn() {
  if (client.connect(server, port)) {
    return true;
  }
  else {
    return false;
  }
}

void escrever() {
  SD.remove("log.txt");
  myFile = SD.open("log.txt", FILE_WRITE);
  if (myFile) {
    myFile.print(URL);
    myFile.close();
    Serial.print("\nGravado com sucesso!");
  }
  else {
    Serial.print("\nerror gravar");
  }
}

void ler() {
  myFile = SD.open("log.txt");
  if (myFile) {
    Serial.print("\nlog.txt: ");
    while (myFile.available()) {
      Serial.write(myFile.read());
    }
    myFile.close();
  }
  else {
    Serial.print("\nerror ler");
  }
}

void printCalculatedAccels() {
  Serial.print(accel.cx);
  Serial.print("\t");
  Serial.print(accel.cy);
  Serial.print("\t");
}

void loop() {
  accel.read();
  printCalculatedAccels();
  if (accel.cx > 1) {
    tone(2, 440);
    delay(500);
    noTone(2);
    int tam;
    CONT++;
    dtostrf(accel.cx, 1, 2, X);
    dtostrf(accel.cy, 1, 2, Y);
    sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
    Serial.print("\nURL: ");
    Serial.print(URL);
    tam = strlen(URL);//quantidade de caracteres presentes no buffer URL
    Serial.print("\nTamanho de URL: ");
    Serial.print(tam);
    //escrever();
    //ler();
    conn();
    client.println(URL);
    client.println("Connection: close");
    client.stop();
    delay(5000);
  }
  Serial.println();
}



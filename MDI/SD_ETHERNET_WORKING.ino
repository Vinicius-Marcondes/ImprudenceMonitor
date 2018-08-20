#include <SPI.h>
#include <SD.h>
#include <Wire.h>
#include <Ethernet.h>
#define port 80
#define ID_ARDUINO  1

File myFile;
IPAddress server(191, 232, 196, 80); //ip da internet
IPAddress ip(192, 168, 100, 60); //ip do arduino
EthernetClient client;
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char URL[64];
int CONT = 15;
int tam;
void setup() {
  Serial.begin(9600);
  while (!Serial);
  Ethernet.begin(mac, ip);
  Serial.print("Initializing SD card...");
  if (!SD.begin(4)) {
    Serial.println("initialization failed!");
  }
  Serial.println("initialization done.");
  sprintf(URL,"GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=1.13&VALOR_Y=0.5",ID_ARDUINO,CONT);
  Serial.println("URL: ");
  Serial.print(URL);
  Serial.println();
  tam = strlen(URL);//quantidade de caracteres presentes no buffer URL
  Serial.println("Tamanho de URL: ");
  Serial.print(tam);
  escrever();
  ler(tam);
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
    Serial.println("done.");
  }
  else {
    Serial.println("error gravar");
  }
}

void ler(int tam) {
  myFile = SD.open("log.txt");
  if (myFile) {
    char buff[tam-2];
    Serial.println("log.txt:");
    while (myFile.available()) {
      myFile.read(buff, tam);
    }
    String aaa = buff;
    Serial.println("tamanho buff: ");
    //Serial.print(strlen(aaa));
    Serial.println("-------------");
    Serial.println(aaa);  
    while(!conn());
    client.println(aaa);
    client.println("Connection: close");
    client.stop();
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
    if (client.write(var)) {
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
  // nothing happens after setup
}



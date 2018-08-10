#include <SD.h>
#include <SPI.h>
#include <Wire.h>
#include <Ethernet.h>
#include <SparkFun_MMA8452Q.h>

MMA8452Q accel;
File myFile;
IPAddress server(191,232,196,80); //ip da internet
IPAddress ip(192,168,100,60); //ip do arduino
EthernetClient client;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char URL[64];
int CONT = 10;
int ID_ARDUINO = 1;
char X[8];
char Y[8];

void setup() {  
  Serial.begin(9600);  
  Serial.print("Initializing SD card...");
  //while (!SD.begin(4));
  Serial.println("DONE");
  accel.init(SCALE_8G, ODR_6); 
  Serial.println("Initializing Ethernet");
  Ethernet.begin(mac, ip);
  delay(5000);
  if(conn() == true){
    Serial.println("DONE");
     tone(2,440);
    delay(500);
    noTone(2);
  }
  else{
    Serial.println("FAILED");
     tone(2,440);
    delay(500);
    noTone(2);
    delay(500);
     tone(2,440);
    delay(500);
    noTone(2);
  }
}

bool conn(){
  if(client.connect(server, 80)){
    return true;
  }
  else{
    return false;
  }  
}

void escrever(char var[64]){
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
void ler(){
  myFile = SD.open("log.txt");
  if (myFile) {
    char buff[128];
    Serial.println("log.txt:");    
    //conn();
    while (myFile.available()) {      
      myFile.read(buff,128);        
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
bool sendData(char var[64]){
  Serial.println(var);
  conn();
  client.println(var);
  client.print("Connection: close");
  client.stop();
  return true;
}

void printCalculatedAccels(){
  Serial.print(accel.cx);
  Serial.print("\t");
  Serial.print(accel.cy);
  Serial.print("\t");
}

void loop() {
  accel.read();
  printCalculatedAccels();
  if(accel.cx > 1){
    tone(2,440);
    delay(500);
    noTone(2);   
    dtostrf(accel.cx, 1, 2, X);
    dtostrf(accel.cy, 1, 2, Y);
    sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
    escrever(URL);
    ler();
    delay(5000);
  }  
  Serial.println(); 
}
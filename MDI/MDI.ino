
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
char X[4];
char Y[4];

void setup() {  
  Serial.begin(9600);  
  Serial.print("Initializing SD card...");
  while (!SD.begin(4));
  Serial.println("DONE");
  accel.init(SCALE_8G, ODR_6); 
  Serial.println("Initializing Ethernet");
  Ethernet.begin(mac, ip);
  delay(5000);
  if(conn() == true){
    Serial.println("DONE");
  }
  else{
    Serial.println("FAILED");
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

void escrever(String var){
  myFile = SD.open("log.txt", FILE_WRITE);
  // if the file opened okay, write to it:
  if (myFile) {
    myFile.println(var);
    // close the file:
    myFile.close();
    Serial.println("done.");
    } else {
      // if the file didn't open, print an error:
      Serial.println("error opening test.txt");
      }
}
void ler(){  
  myFile = SD.open("log.txt");
  if (myFile) {
    Serial.println("log.txt:");
    while (myFile.available()) {
      int AA = myFile.read();
      Serial.write(AA); 
    }    
    myFile.close();
  } 
  else {    
    Serial.println("error opening test.txt");
  }
}

void loop() {
  accel.read();
  if(accel.cx > 1){
    float VALOR_X = accel.cx;
    float VALOR_Y = accel.cy;
    dtostrf(VALOR_X, 1, 2, X);
    dtostrf(VALOR_Y, 1, 2, Y);
    sprintf(URL, "GET /update.php?ID_ARDUINO=%d&CONT=%d&VALOR_X=%s&VALOR_Y=%s", ID_ARDUINO, CONT, X, Y);
    escrever(URL);
    ler();
  } 
}

#include <SPI.h>
#include <Ethernet.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};

IPAddress ip(192,168,43,17); // asta e adresa asignata - PT ORANGE!!! cu shared netword intre ethernet si wireless
//IPAddress ip(192,168,0,17);
//IPAddress ip( 169,254,183,87);
char value;
#define RELAY_ON 0
#define RELAY_OFF 1
#define Relay_1  2

double mVperAmp = 66;

double Voltage;
double Voltage2;
double Power;
double VRMS;
double AmpsRMS;

char commandbuffer[100];
byte bluetoothRead;
float a;

char server[] = "93.188.164.20";

EthernetClient client;

void setup()
{
  digitalWrite(Relay_1, RELAY_OFF);
  pinMode(Relay_1, OUTPUT);  
  
  Serial.begin(9600);

  Ethernet.begin(mac, ip);
}

void loop()
{
  int i = 0;
  if (Serial.available())
  {
    while (Serial.available())
    {
      commandbuffer[i++] = Serial.read();
    }
    a = atof(commandbuffer);
    if (i > 0)
               //Serial.println((char*)commandbuffer);
    Voltage2 = a;
     AmpsRMS = Voltage2 * 220.0;

    //Serial.println(Voltage2);
    //Serial.println(AmpsRMS);
    //delay(500);
    if (client.connect(server, 80)) {
      client.print("GET /write_data.php?"); // This
      client.print("value="); 
      client.print(AmpsRMS); 
      client.print("&value2=");
      client.print(Voltage2);
      client.println(" HTTP/1.1");
      client.println("Host: 93.188.164.20");
      client.println("Connection: close"); 
      client.println();
      client.println();
      client.stop();
    }
    else {
     
       }
      if(true){
       if (client.connect(server, 80)) {
        // Make a HTTP request:
        client.println("GET /fetchRelayStatus.php");
        client.println("Host: 93.188.164.20");
        client.println("Connection: close");
        client.println();
        //client.stop();
      } 
        if (client.available()) {
              char c = client.read();
              Serial.println(c);
              if(c == 'A'){digitalWrite(Relay_1, RELAY_ON);}
              if(c == 'F'){digitalWrite(Relay_1, RELAY_OFF);}
              client.stop();
            }
     
      }
     
  }
  
  
}



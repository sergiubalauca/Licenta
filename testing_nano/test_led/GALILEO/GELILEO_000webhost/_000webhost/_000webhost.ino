#include <SPI.h>
#include <Ethernet.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};

// Enter the IP address for Arduino, as mentioned we will use 192.168.0.16
// Be careful to use , insetead of . when you enter the address here
IPAddress ip(192, 168, 0, 154); // asta e adresa asignata

char value;

double mVperAmp = 66; // use 100 for 20A Module and 185 for 5 Module

double Voltage;
double Voltage2;
double Power;
double VRMS;
double AmpsRMS;

char commandbuffer[100];
byte bluetoothRead;
float a;

char server[] = "31.220.104.175"; // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie. "www.yourwebpage.com")

// Initialize the Ethernet server library
EthernetClient client;

void setup()
{
  Serial.begin(9600);
  Serial1.begin(9600);

  Ethernet.begin(mac, ip);

  Serial.println("-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");
  Serial.print("IP Address        : ");
  Serial.println(Ethernet.localIP());
  Serial.print("Subnet Mask       : ");
  Serial.println(Ethernet.subnetMask());
  Serial.print("Default Gateway IP: ");
  Serial.println(Ethernet.gatewayIP());
  Serial.print("DNS Server IP     : ");
  Serial.println(Ethernet.dnsServerIP());

}

void loop()
{
  int i = 0;

  if (Serial1.available())
  {
    while (Serial1.available())
    {
      commandbuffer[i++] = Serial1.read();
    }
    //commandbuffer[i++]='\0';
    a = atof(commandbuffer); // converteste din arrayul commandbuffer in integer
    if (i > 0)
      Serial.println((char*)commandbuffer);
    //delay(500);
    //Voltage = getVPP();
    Voltage2 = a;
    //Voltage2 = Voltage * 80;
    //VRMS = (Voltage / 1.0) * 0.707; //era initial /2.0
    AmpsRMS = Voltage2 * 220.0;

    //Serial.println(Voltage2);
    //Serial.println(AmpsRMS);

    Serial1.println(Voltage2);
    Serial1.println(AmpsRMS);
    //delay(500);
    if (client.connect(server, 80)) {
      client.print("GET /write_data.php?"); // This
      client.print("value="); // This
      client.print(AmpsRMS); //We are making a GET request just like we would from our browser but now with live data from the sensor
      //client.print("GET /write_data.php?");
      client.print("&value2="); //am pus & pt a doua citire
      client.print(Voltage2);
      client.println(" HTTP/1.1"); // Part of the GET request
      client.println("Host: 31.220.104.175"); // IMPORTANT: find out the IP address of your computer and put it here
      client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
      client.println(); // Empty line
      client.println(); // Empty line
      client.stop();    // Closing connection to server
    }
    else {
      // If Arduino can't connect to the server
      Serial.println("Connection failed, trying again......\n");
      
      if (client.connect(server, 80)) {
        client.print("GET /write_data.php?"); // This
        client.print("value="); // This
        client.print(AmpsRMS); //We are making a GET request just like we would from our browser but now with live data from the sensor
        //client.print("GET /write_data.php?");
        client.print("&value2="); //am pus & pt a doua citire
        client.print(Voltage2);
        client.println(" HTTP/1.1"); // Part of the GET request
        client.println("Host: 192.168.0.101"); // IMPORTANT: find out the IP address of your computer and put it here
        client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
        client.println(); // Empty line
        client.println(); // Empty line
        client.stop();    // Closing connection to server
      }
    }

    // Give the server some time to receive the data and store it. I used 10 seconds here. Be advised when delaying. If u use a short delay, the server might not capture data because of Arduino transmitting new data too soon.


  }
  delay(5000);
}



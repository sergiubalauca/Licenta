#include <SPI.h>
#include <Ethernet.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};

// Enter the IP address for Arduino, as mentioned we will use 192.168.0.16
// Be careful to use , insetead of . when you enter the address here
IPAddress ip(192, 168, 0, 154); // asta e adresa asignata

float sensorIn = A5;  // Analog input pin on Arduino we connected the SIG pin from sensor
float photocellReading;  // Here we will place our reading
double mVperAmp = 66; // use 100 for 20A Module and 185 for 5 Module

double Voltage;
double Voltage2;
double Power;
double VRMS;
double AmpsRMS;


char server[] = "192.168.0.103"; // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie. "www.yourwebpage.com")

// Initialize the Ethernet server library
EthernetClient client;

void setup() {

  // Serial.begin starts the serial connection between computer and Arduino
  Serial.begin(9600);

  // start the Ethernet connection
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

void loop() {
  Voltage = getVPP();
  Voltage2 = Voltage * 80; // asta numai ca sa printez si voltajul pe serial monitor

  VRMS = (Voltage / 1.0) * 0.707; //era initial /2.0

  AmpsRMS = (VRMS * 1000) / mVperAmp;
  Serial.println(Voltage2);
  // Fill the sensorReading with the information from sensor

  // Connect to the server (your computer or web page)
  if (client.connect(server, 80)) {
    client.print("GET /write_data.php?"); // This
    client.print("value="); // This
    client.print(AmpsRMS); //We are making a GET request just like we would from our browser but now with live data from the sensor
    //client.print("GET /write_data.php?");
    client.print("&value2="); //am pus & pt a doua citire
    client.print(Voltage2);
    client.println(" HTTP/1.1"); // Part of the GET request
    client.println("Host: 192.168.0.103"); // IMPORTANT: find out the IP address of your computer and put it here
    client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
    client.println(); // Empty line
    client.println(); // Empty line
    client.stop();    // Closing connection to server

  }


  if (client.connect(server, 80)) {
    client.print("GET /write_curent.php?"); // This
    client.print("value="); // This
    client.print(AmpsRMS);
    client.println(" HTTP/1.1"); // Part of the GET request
    client.println("Host: 192.168.0.103"); // IMPORTANT: find out the IP address of your computer and put it here
    client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
    client.println(); // Empty line
    client.println(); // Empty line
    client.stop();    // Closing connection to server

  }


  if (client.connect(server, 80)) {
    client.print("GET /write_tensiune.php?"); // This
    client.print("value="); // This
    client.print(Voltage2);
    client.println(" HTTP/1.1"); // Part of the GET request
    client.println("Host: 192.168.0.103"); // IMPORTANT: find out the IP address of your computer and put it here
    client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
    client.println(); // Empty line
    client.println(); // Empty line
    client.stop();    // Closing connection to server

  }

  if (client.connect(server, 80)) {
    client.print("GET /write_putere.php?"); // This
    client.print("value="); // This
    client.print(AmpsRMS * Voltage2);
    client.println(" HTTP/1.1"); // Part of the GET request
    client.println("Host: 192.168.0.103"); // IMPORTANT: find out the IP address of your computer and put it here
    client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
    client.println(); // Empty line
    client.println(); // Empty line
    client.stop();    // Closing connection to server

  }

  else {
    // If Arduino can't connect to the server
    Serial.println("--> connection failed\n");
  }

  // Give the server some time to receive the data and store it. I used 10 seconds here. Be advised when delaying. If u use a short delay, the server might not capture data because of Arduino transmitting new data too soon.
  delay(4000);
}










//functia de citire voltaj
float getVPP()

{

  float result;

  int readValue; //value read from the sensor

  int maxValue = 0; // store max value here

  int minValue = 1023; // store min value here

  uint32_t start_time = millis();

  while ((millis() - start_time) < 1000) //sample for 1 Sec
  {
    readValue = analogRead(sensorIn);
    // see if you have a new maxValue
    Serial.println(readValue);
    if (readValue > maxValue)
    {
      /*record the maximum sensor value*/
      maxValue = readValue;
    }
    if (readValue < minValue)
    {
      /*record the maximum sensor value*/
      minValue = readValue;
    }
  }
  // Subtract min from max

  result = ((maxValue - minValue) * 4.50) / 1023.0; // era imultit cu 5.0

  return result;
}

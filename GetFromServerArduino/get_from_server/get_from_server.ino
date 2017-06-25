#include <SPI.h>
#include <Ethernet.h>

// Enter a MAC address for your controller below.
// Newer Ethernet shields have a MAC address printed on a sticker on the shield
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
String readString;
#define RELAY_ON 0
#define RELAY_OFF 1
/*-----( Declare objects )-----*/
/*-----( Declare Variables )-----*/
#define Relay_1  2  // Arduino Digital I/O pin number
char server[] = "93.188.164.20";    // name address for Google (using DNS)

// Set the static IP address to use if the DHCP fails to assign
IPAddress ip(192,168,0,17);

// Initialize the Ethernet client library
// with the IP address and port of the server 
// that you want to connect to (port 80 is default for HTTP):
EthernetClient client;

void setup() {
 // Open serial communications and wait for port to open:
 digitalWrite(Relay_1, RELAY_OFF);
 
  
//---( THEN set pins as outputs )----  
  pinMode(Relay_1, OUTPUT);   
  
  Serial.begin(9600);
   while (!Serial) {
    ; // wait for serial port to connect. Needed for Leonardo only
  }

  // start the Ethernet connection:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // no point in carrying on, so do nothing forevermore:
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip);
  }
  // give the Ethernet shield a second to initialize:
  delay(1000);
  Serial.println("connecting...");

  // if you get a connection, report back via serial:
  
}

void loop()
{
  if (client.connect(server, 80)) {
    // Make a HTTP request:
    client.println("GET /fetchRelayStatus.php");
    client.println("Host: 93.188.164.20");
    client.println("Connection: close");
    client.println();
    //client.stop();
  } 
  else {
  }
  if (client.available()) {
    char c = client.read();
    Serial.print(c);
    if(c == 'A')
    {
      digitalWrite(Relay_1, RELAY_ON);// set the Relay ON
      delay(5000);     
    }
    if(c == 'F')
    {
      digitalWrite(Relay_1, RELAY_OFF);// set the Relay ON
      delay(5000);     
    }
    client.stop();
  }

  // if the server's disconnected, stop the client:
  
delay(1000);
}



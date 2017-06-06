//98:84:E3:2D:59:69
#define ledPin 7

#include <SoftwareSerial.h>
SoftwareSerial BTserial(0, 1); 
char c = ' ';
int state = 0;
float sensorIn = A5;
int readValue;
void setup() {
  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, HIGH);
  Serial.begin(9600); // Default communication rate of the Bluetooth module
  Serial.println("serial begin");
  BTserial.begin(9600); 
  Serial.println("BTSerial Begin");
}
void loop() {
  readValue = analogRead(sensorIn);

if (BTserial.available())
    {  
        c = BTserial.read();
        BTserial.write(c+"\r\n");
        BTserial.write("BTSerial available");
    }
  
  if(Serial.available() > 0){ // Checks whether data is comming from the serial port
    state = Serial.read(); // Reads the data from the serial port
 }

if (Serial.available())
    {
        c =  Serial.read();
        Serial.write(c);
        Serial.write("AT");
        Serial.write("Serial available");  
    }
 
 if (state == '0') {
  digitalWrite(ledPin, LOW); // Turn LED OFF
  Serial.println("LED: OFF"); // Send back, to the phone, the String "LED: ON"
  state = 0;
 }
 else if (state == '1') {
  digitalWrite(ledPin, HIGH);
  Serial.println("LED: ON");
  Serial.println(readValue);
  
 // BTserial.write(readValue); // incercare de a trimite la GALILEO
  state = 0;
 } 
}

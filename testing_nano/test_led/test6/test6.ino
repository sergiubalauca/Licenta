#include <SoftwareSerial.h>
#define ledPin 7
int state = 0;
float sensorIn = A5;
int readValue;

SoftwareSerial BTserial(2, 3); // RX | TX
// Connect the HC-05 TX to Arduino pin 2 RX. 
// Connect the HC-05 RX to Arduino pin 3 TX through a voltage divider.
// 
 
char c = ' ';
 
void setup() 
{
  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, HIGH);
  
    Serial.begin(9600);
    Serial.println("Arduino is ready");
    Serial.println("Remember to select Both NL & CR in the serial monitor");
 
    // HC-05 default serial speed for AT mode is 38400
    BTserial.begin(9600);  
}
 
void loop()
{
  readValue = analogRead(sensorIn);
    // Keep reading from HC-05 and send to Arduino Serial Monitor
    if (BTserial.available())
    {  
        c = BTserial.read();
        Serial.write(c);
    }
 
    // Keep reading from Arduino Serial Monitor and send to HC-05
    if (Serial.available())
    {
        c =  Serial.read();
        BTserial.write(c);  
    }

    if (state == '0') {
       digitalWrite(ledPin, LOW); // Turn LED OFF
        Serial.println("LED: OFF"); // Send back, to the phone, the String "LED: ON"
       state = 0;
      }
      else if (state == '1') {
        digitalWrite(ledPin, HIGH);
        Serial.println("LED: ON");
        BTserial.write(readValue);
        //Serial.Write('1'); // incercare de a trimite la GALILEO
        state = 0;
}
}

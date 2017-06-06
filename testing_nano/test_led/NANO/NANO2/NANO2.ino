//98:84:E3:2D:59:69
#define ledPin 7

#include <SoftwareSerial.h>
SoftwareSerial BTserial(0, 1);
char c = ' ';
int state = 0;
float sensorIn = A5;
int readValue;
float result;

void setup() {
  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, HIGH);
  Serial.begin(9600); // Default communication rate of the Bluetooth module
  //Serial.println("serial begin");
  BTserial.begin(9600);
  //Serial.println("BTSerial Begin");
}
void loop() {
  readValue = analogRead(sensorIn);
  result = readValue * (5.0 / 1023.0);

  if (BTserial.available())
  {
    c = BTserial.read();
    //BTserial.write(c + "\r\n");
    //BTserial.write("BTSerial available");
  }


  if (Serial.available()) {

    Serial.println(result);
    delay(5000);

    // BTserial.write(readValue); // incercare de a trimite la GALILEO
    state = 0;
  }
}

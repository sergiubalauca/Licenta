//98:84:E3:2D:59:69
#define ledPin 7

#include <SoftwareSerial.h>
SoftwareSerial BTserial(0, 1);
char c = ' ';
int state = 0;
float sensorIn = A5;
int readValue;

double mVperAmp = 66;
double Voltage;
double Voltage2;
double Power;
double VRMS;
double AmpsRMS;

void setup() {
  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, HIGH);
  Serial.begin(9600); // Default communication rate of the Bluetooth module
  Serial.println("serial begin");
  BTserial.begin(9600);
  Serial.println("BTSerial Begin");
}
void loop() {
  //readValue = analogRead(sensorIn);
  getVPP();

  // Serial.println(readValue);
  //Serial.println(AmpsRMS);
  if (BTserial.available())
  {
    c = BTserial.read();
    BTserial.write(c + "\r\n");
    BTserial.write("BTSerial available");
  }


  if (true) {

    //Serial.println(readValue);
    //delay(200);

    // BTserial.write(readValue); // incercare de a trimite la GALILEO
    state = 0;
  }
}


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
    //Serial.println(readValue);
    // see if you have a new maxValue
    //Serial.println(readValue);
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
  //Serial.println(readValue);

  result = readValue * (4.50 / 1023.0); // era imultit cu 5.0
  Serial.println(result);
  Voltage = result;
  Voltage2 = Voltage * 80; // asta numai ca sa printez si voltajul pe serial monitor

  VRMS = (Voltage / 1.0) * 0.707; //era initial /2.0

  AmpsRMS = (VRMS * 1000) / mVperAmp;
  Serial.println(Voltage2);
  Serial.println(AmpsRMS);
  return result;
}

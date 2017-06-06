#include <LiquidCrystal.h>

#include <SPI.h>
#include <Ethernet.h>

LiquidCrystal lcd(8, 2, 4, 5, 6, 7); // am pus pinul 8 ca TX pentru ca deja e ocupat de bluetooth

float sensorIn = A5;  // Analog input pin on Arduino we connected the SIG pin from sensor
float photocellReading;  // Here we will place our reading
double mVperAmp = 66; // use 100 for 20A Module and 185 for 5 Module

double Voltage;
double Voltage2;
double Power;
double VRMS;
double AmpsRMS;

void setup() {

  // Serial.begin starts the serial connection between computer and Arduino
  Serial.begin(9600);
  lcd.begin(16, 2);
  // lcd.clear();
}

void loop() {

  Voltage = getVPP();
  Voltage2 = Voltage * 80; // asta numai ca sa printez si voltajul pe serial monitor
  VRMS = (Voltage / 1.0) * 0.707; //era initial /2.0
  AmpsRMS = (VRMS * 1000) / mVperAmp;
  // Fill the sensorReading with the information from sensor
  //Serial.println(Voltage2);
  //Serial.println(AmpsRMS);
  // Connect to the server (your computer or web page)

  if (Serial.available()) {

    Serial.println(Voltage2);

  }
  // Give the server some time to receive the data and store it. I used 10 seconds here. Be advised when delaying. If u use a short delay, the server might not capture data because of Arduino transmitting new data too soon.
  lcd.print("Tensiune");
  lcd.setCursor(2, 1);
  lcd.print(Voltage2);
  lcd.setCursor(10, 0);
  lcd.print("Curent");
  lcd.setCursor(10,1);
  lcd.print(AmpsRMS);
  delay(5000);
  lcd.clear();
//  delay(4000);
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

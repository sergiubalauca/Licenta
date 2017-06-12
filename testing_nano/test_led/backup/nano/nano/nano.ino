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
//=================================================================================================
double current;
const int currentPin = A5;
const unsigned long sampleTime = 100000UL;                           // sample over 100ms, it is an exact number of cycles for both 50Hz and 60Hz mains
const unsigned long numSamples = 250UL;                               // choose the number of samples to divide sampleTime exactly, but low enough for the ADC to keep up
const unsigned long sampleInterval = sampleTime / numSamples; // the sampling interval, must be longer than then ADC conversion time
const int adc_zero = 508;
//=================================================================================================
void setup() {

  // Serial.begin starts the serial connection between computer and Arduino
  Serial.begin(9600);
  lcd.begin(16, 2);
  // lcd.clear();
}

void loop() {

  Voltage = CurrentSense();
  Voltage2 = Voltage * 220; // asta numai ca sa printez si voltajul pe serial monitor
  VRMS = (Voltage / 2.0) * 0.707; //era initial /2.0
  AmpsRMS = (VRMS * 1000) / mVperAmp;
 // Serial.println(analogRead(sensorIn));
  //float voltage = analogRead(sensorIn) * (250.0 / 1024.0);
  //float voltage = getVPP();
  // Fill the sensorReading with the information from sensor
  //  Serial.println("voltage");
  //  Serial.println(voltage);
  //  Serial.println(analogRead(sensorIn));
  //Serial.println(AmpsRMS);
  // Connect to the server (your computer or web page)


  if (Serial.available()) {

    Serial.println(Voltage);

  }
  // Give the server some time to receive the data and store it. I used 10 seconds here. Be advised when delaying. If u use a short delay, the server might not capture data because of Arduino transmitting new data too soon.
  lcd.print("Power");
  lcd.setCursor(1, 1);
  lcd.print(Voltage2);
  lcd.setCursor(9, 0);
  lcd.print("Current");
  lcd.setCursor(9, 1);
  lcd.print(Voltage);
  delay(5000);
  lcd.clear();
  //  delay(4000);
}


//=================================================================================================================
float CurrentSense()
{
  int maxValue = 0;
  int minValue = 1023;

  unsigned long currentAcc = 0;
  unsigned int count = 0;
  unsigned long prevMicros = micros() - sampleInterval ;
  while (count < numSamples)
  {
    if (micros() - prevMicros >= sampleInterval)
    {

      // see if you have a new maxValue
      if (analogRead(currentPin) > maxValue)
      {
        maxValue = analogRead(currentPin);
      }
      if (analogRead(currentPin) < minValue)
      {
        minValue = analogRead(currentPin);
      }

      int adc_raw = analogRead(currentPin) - adc_zero;
      //int adc_raw = minValue - maxValue;
      currentAcc += (unsigned long)(adc_raw * adc_raw);
      ++count;
      prevMicros += sampleInterval;
    }
  }

  float rms = sqrt((float)currentAcc / (float)numSamples) * (75.75 / 1024.0);
  rms = rms - 0.05;
  if (rms < 0.01789)
  {
    rms = 0;
  }
  //Serial.println(rms);
  return rms;
}

//=================================================================================================================

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

  result = ((maxValue - minValue) * 4.70) / 1023.0; // era imultit cu 5.0

  return result;
}

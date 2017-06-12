#include <LiquidCrystal.h>

#include <SPI.h>
#include <Ethernet.h>

LiquidCrystal lcd(8, 2, 4, 5, 6, 7); // am pus pinul 8 ca TX pentru ca deja e ocupat de bluetooth

//float sensorIn = A5;  // Analog input pin on Arduino we connected the SIG pin from sensor
//float photocellReading;  // Here we will place our reading
//double mVperAmp = 66; // use 100 for 20A Module and 185 for 5 Module

double Voltage;
double Voltage2;
double Power;
double VRMS;
double AmpsRMS;

double current;
const int currentPin = A5;
const unsigned long sampleTime = 100000UL;                           // sample over 100ms, it is an exact number of cycles for both 50Hz and 60Hz mains
const unsigned long numSamples = 250UL;                               // choose the number of samples to divide sampleTime exactly, but low enough for the ADC to keep up
const unsigned long sampleInterval = sampleTime / numSamples; // the sampling interval, must be longer than then ADC conversion time
const int adc_zero = 514;

void setup() {

  // Serial.begin starts the serial connection between computer and Arduino
  Serial.begin(9600);
  lcd.begin(16, 2);
  // lcd.clear();
}

void loop() {

  current = CurrentSense();
  Voltage = current * 220;
  //  Voltage = getVPP2();
  //  VRMS = (Voltage / 2.0) * 0.707;
  //  AmpsRMS = (VRMS * 1000) / mVperAmp;

  //Serial.print(AmpsRMS);
  //Serial.println(" Amps RMS");

  if (Serial.available()) {

    Serial.println(current);
    Serial.println(analogRead(currentPin));

  }
  // Give the server some time to receive the data and store it. I used 10 seconds here. Be advised when delaying. If u use a short delay, the server might not capture data because of Arduino transmitting new data too soon.
  lcd.print("Tensiune");
  lcd.setCursor(2, 1);
  lcd.print(Voltage);
  lcd.setCursor(10, 0);
  lcd.print("Curent");
  lcd.setCursor(10, 1);
  lcd.print(current);
  delay(5000);
  lcd.clear();
  //  delay(4000);
}

//=================================================================================================================
float CurrentSense()
{
  unsigned long currentAcc = 0;
  unsigned int count = 0;
  unsigned long prevMicros = micros() - sampleInterval ;
  while (count < numSamples)
  {
    if (micros() - prevMicros >= sampleInterval)
    {
      int adc_raw = analogRead(currentPin) - adc_zero;
      currentAcc += (unsigned long)(adc_raw * adc_raw);
      ++count;
      prevMicros += sampleInterval;
    }
  }

  float rms = sqrt((float)currentAcc / (float)numSamples) * (75.75 / 1024.0);
  rms = rms - 0.08;
  if (rms < 0.10)
  {
    rms = 0;
  }

  return rms;
}

//=================================================================================================================

float getVPP2() {
  int rVal = 0;
  int sampleDuration = 100;       // 100ms
  int sampleCount = 0;
  unsigned long rSquaredSum = 0;
  int rZero = 516;                // For illustrative purposes only - should be measured to calibrate sensor.

  uint32_t startTime = millis();  // take samples for 100ms
  while ((millis() - startTime) < sampleDuration)
  {
    rVal = analogRead(A5) - rZero;
    rSquaredSum += rVal * rVal;
    sampleCount++;
  }

  double voltRMS = 5.0 * sqrt(rSquaredSum / sampleCount) / 1024.0;

  // x 1000 to convert volts to millivolts
  // divide by the number of millivolts per amp to determine amps measured
  // the 20A module 100 mv/A (so in this case ampsRMS = 10 * voltRMS
  double ampsRMS = voltRMS * 6.6;
  return (ampsRMS);
}

//=================================================================================================================
//functia de citire voltaj
float getVPP()
{
  float result;

  int readValue;             //value read from the sensor
  int maxValue = 0;          // store max value here
  int minValue = 1024;          // store min value here

  uint32_t start_time = millis();
  while ((millis() - start_time) < 1000) //sample for 1 Sec
  {
    readValue = analogRead(currentPin);
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
  result = ((maxValue - minValue) * 5.0) / 1024.0;

  return result;
}

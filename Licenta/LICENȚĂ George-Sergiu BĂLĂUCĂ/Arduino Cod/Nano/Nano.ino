#include <LiquidCrystal.h>

#include <SPI.h>
#include <Ethernet.h>

LiquidCrystal lcd(8, 2, 4, 5, 6, 7); // am pus pinul 8 ca TX pentru ca deja e ocupat de bluetooth

float sensorIn = A5;
float photocellReading;
double mVperAmp = 66;

double Voltage;
double Voltage2;
double Power;
double VRMS;
double AmpsRMS;
//=================================================================================================
double current;
const int currentPin = A5;
const unsigned long sampleTime = 100000UL;                           
const unsigned long numSamples = 250UL;                              
const unsigned long sampleInterval = sampleTime / numSamples;
const int adc_zero = 508;
//=================================================================================================
void setup() {

 
  Serial.begin(9600);
  lcd.begin(16, 2);
  // lcd.clear();
}

void loop() {

  Voltage = CurrentSense();
  Voltage2 = Voltage * 220; // asta numai ca sa printez si voltajul pe serial monitor
  VRMS = (Voltage / 2.0) * 0.707; //era initial /2.0
  AmpsRMS = (VRMS * 1000) / mVperAmp;

  if (Serial.available()) {

    Serial.println(Voltage);

  }
  
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
      int adc_raw = analogRead(currentPin) - adc_zero;
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
  return rms;
}

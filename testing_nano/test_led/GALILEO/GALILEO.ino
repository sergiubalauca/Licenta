char value;


void setup()
{
  Serial.begin(9600);
  Serial1.begin(9600);
}

void loop()
{
  int i=0;
  char commandbuffer[100];
  
  if(Serial1.available())
  {
     while(Serial1.available()&& i< 5)
     {
        commandbuffer[i++] = Serial1.read();
     }
     //commandbuffer[i++]='\0';
     if(i>0)
     Serial.println((char*)commandbuffer);

  }

  //if (tempvalue>0)
  //  {
    //  Serial.println(value);
    //  actualValue = tempvalue.substring(0, 3);
   // }
}


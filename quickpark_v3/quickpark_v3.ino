#include <LiquidCrystal_I2C.h>

int greenLeds[2] = {11, 12};
int Echos[2] = {3, 5};
int Trigs[2] = {2, 4};
int distances[2];
LiquidCrystal_I2C lcd(0x3D, 16, 2);

void setup() {
  Serial.begin(9600);
 
  for(int i=0; i<2; i++){
    pinMode(Trigs[i], OUTPUT);
    pinMode(Echos[i], INPUT);
    pinMode(greenLeds[i], OUTPUT);
  }
  lcd.init();
  lcd.clear();
  lcd.backlight();
  lcd.setCursor(4,0);
  lcd.print("QuickPark");
  
  lcd.setCursor(0,1);
  lcd.print("Wolne miejsca:");
  
}

void loop() {
  int freespaces = 2;
  //Serial.print("\n--------");
  for(int i=0; i<2; i++){
    //Serial.print("\n");
    distances[i] = FindDistance(Trigs[i], Echos[i]);
    LED(distances[i], greenLeds[i]);
    Serial.println(distances[i]);  
    if(distances[i] < 50)
      freespaces--;
  }
  lcd.setCursor(15, 1);
  lcd.print(freespaces);
  //Serial.print("\nWolne miejsca: ");
  //Serial.print(freespaces);
  delay(1500);
}

int FindDistance(int TRIGf, int ECHOf){
  int distancef;
  digitalWrite(TRIGf, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIGf, HIGH);
  delayMicroseconds(2);
  digitalWrite(TRIGf, LOW);
  digitalWrite(ECHOf, HIGH);
  distancef = (pulseIn(ECHOf, HIGH))/58;
  return distancef;
}
void LED(int distanceled, int LED){
  if(distanceled < 50)
    digitalWrite(LED, LOW);
  else
    digitalWrite(LED, HIGH);
}

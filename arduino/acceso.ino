#include <Wiegand.h>
#include <SPI.h>
#include <Ethernet.h>

#define WIEGAND_D0 2
#define WIEGAND_D1 3
#define BUZZER 7
#define LED_GREEN 5

byte LOCAL_MAC[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte LOCAL_IP[] = { 172, 16, 111, 21 };
char SERVER[] = "192.168.1.167";

Wiegand wiegand;

EthernetClient client;

void setup()
{
  Serial.begin(9600);
    
  Ethernet.begin(LOCAL_MAC, LOCAL_IP);
  //SERVER.begin();
  Serial.print("IP Address: ");
  Serial.println(Ethernet.localIP());
  pinMode(BUZZER, LOW);
  

  //Install listeners and initialize Wiegand reader
  wiegand.onReceive(receivedData, "Card readed: ");
  wiegand.onReceiveError(receivedDataError, "Card read error: ");
  wiegand.onStateChange(stateChanged, "State changed: ");
  wiegand.begin(Wiegand::LENGTH_ANY, true);

  //initialize pins as INPUT and attaches interruptions
  pinMode(WIEGAND_D0, INPUT);
  pinMode(WIEGAND_D1, INPUT);
  attachInterrupt(digitalPinToInterrupt(WIEGAND_D0), pinStateChanged, CHANGE);
  attachInterrupt(digitalPinToInterrupt(WIEGAND_D1), pinStateChanged, CHANGE);

  //Sends the initial pin state to the Wiegand library
  pinStateChanged();

}

void loop () {
  noInterrupts();
  wiegand.flush();
  interrupts();
  //Sleep a little -- this doesn't have to run very often.
  delay(100);
}

// When any of the pins have changed, update the state of the wiegand library
void pinStateChanged() {
  wiegand.setPin0State(digitalRead(WIEGAND_D0));
  wiegand.setPin1State(digitalRead(WIEGAND_D1));
}

// Notifies when a reader has been connected or disconnected.
// Instead of a message, the seconds parameter can be anything you want -- Whatever you specify on `wiegand.onStateChange()`
void stateChanged(bool plugged, const char* message) {
    Serial.print(message);
    Serial.println(plugged ? "CONNECTED" : "DISCONNECTED");
}

// Notifies when a card was read.
// Instead of a message, the seconds parameter can be anything you want -- Whatever you specify on `wiegand.onReceive()`
void receivedData(uint8_t* data, uint8_t bits, const char* message) {
    Serial.print(message);
    Serial.print(bits);
    Serial.print("bits / ");
    //Print value in HEX
    uint8_t bytes = (bits+7)/8;
    Serial.println(bytes);
    String codigo_tarjeta = "";
    for (int i=0; i<bytes; i++) {
        String dec = String(data[i], HEX);
        if(dec.length() == 1)  dec = "0" + dec;
        codigo_tarjeta = codigo_tarjeta + dec;
        Serial.print(data[i] >> 4, 16);
        Serial.print(data[i] & 0xF, 16);
    }
    Serial.println();
    Serial.println(codigo_tarjeta);




     sendGET(codigo_tarjeta); 
}


// Notifies when an invalid transmission is detected
void receivedDataError(Wiegand::DataError error, uint8_t* rawData, uint8_t rawBits, const char* message) {
    Serial.print(message);
    Serial.print(Wiegand::DataErrorStr(error));
    Serial.print(" - Raw data: ");
    Serial.print(rawBits);
    Serial.print("bits / ");

    //Print value in HEX
    uint8_t bytes = (rawBits+7)/8;
    for (int i=0; i<bytes; i++) {
        Serial.print(rawData[i] >> 4, 16);
        Serial.print(rawData[i] & 0xF, 16);
    }
    Serial.println();
}


void sendGET(String codigo_tarjeta) //client function to send/receive GET request data.
{
  if (client.connect(SERVER, 80)) {  //starts client connection, checks for connection
    Serial.println("connected");
    Serial.println("GET /api/access/" +codigo_tarjeta + " HTTP/1.0");
    client.println("GET /api/access/" +codigo_tarjeta + " HTTP/1.0"); //download text
    client.println("Host: 192.168.1.167");
    client.println(); //end of get request
  } 
  else {
    Serial.println("connection failed"); //error message if no client connect
    Serial.println();
  }

  while(client.connected() && !client.available()) delay(1); //waits for data
  while (client.connected() || client.available()) { //connected or data available
    char c = client.read(); //gets byte from ethernet buffer
    Serial.print(c); //prints byte to serial monitor 
  }

  Serial.println();
  Serial.println("disconnecting.");
  Serial.println("==================");
  Serial.println();
  client.stop(); //stop client

}

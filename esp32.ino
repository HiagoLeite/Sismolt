#include <WiFi.h>

const char* ssid = "Silvana";
const char* password = "Silvana.87841781";
const char* host = "192.168.15.3";//ip ou site sem .ext

//Sensor de umidade, portas leds.
//int pinoSensor=33;
int ledVermelho=19;
int ledVerde=18;
int ledBranco=17;

//INFORMAÇÕES
int sensor;
char* grauPerigo=""; 
char* estado=""; 
int idUsuario=1;

//AUXILIARES
int aux=0;
int res=0;
int contPerigo=0;

void setup()
{
    Serial.begin(9600);
//  pinMode(pinoSensor, INPUT);
    pinMode(ledVermelho, OUTPUT);
    pinMode(ledVerde, OUTPUT);
    pinMode(ledBranco, OUTPUT);
    delay(10);
   
    // CONEXAO COM WIFI
    Serial.println();
    Serial.println();
    Serial.print("Conectando com: ");
    Serial.println(ssid);
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("");
    Serial.println("WiFi conectado");
    Serial.println("IP: ");
    Serial.println(WiFi.localIP());
}

void loop()
{
    //LE O VALOR DO SENSOR
//  sensor = analogRead(pinoSensor);
    //SIMULA O SENSOR    
    sensor=random(0,1024);
    Serial.println("Valor captado: "+(String)sensor);
    logicaLed();
    
    //PRIMEIRA LEITURA NÃO SALVA, DEVIDO A AUX SER 0
    logicaBd(sensor,aux);
    //PASSA O VALOR CAPTADO PARA UM VARIAVEL    
    aux=sensor;
    
    //VERIFICA SE O ESTAO DE PERIGO ESTA SE REPITINDO AFIM DE ENVIAR UM ALERTA    
    if(aux<=400){
      contPerigo++;
      if(contPerigo==5){
        //METODO PARA MANDAR EMAIL AVISANDO DO PERIGO        
      } 
    }else{
      contPerigo=0;
    }
    delay(3000);
}

/*METODO PARA FAZER REQUISIÇÃO (ESTE METODO TEM UMA LOGICA PARA NÃO SOBRE CARREGAR O BANCO COM 
INFORMAÇÕES REPITIDAS*/
void logicaBd(int valorA,int valorB){
  
  if(valorA>valorB){
     res=valorA-valorB;
  }else if(valorB>valorA){
     res=valorA-valorB;
  }else{
     res=0;
  }
  
  if(res>=250){
      Serial.print("Conectando com ");
      Serial.println(host);

      // TCP CONEXÃO
      WiFiClient client;

      const int httpPort = 80;
      if (!client.connect(host, httpPort)) {
          Serial.println("Falha ao se conectar");
          return;
      }
      // URL REQUISIÇÃO
      String url = "/Sismolt/php/salvarDadosDb.php?";
      url += "sensor=";
      url += sensor; 
      url += "&estado=";
      url += estado;
      url += "&grauPerigo=";
      url += grauPerigo;
      url += "&idUsuario=";
      url += idUsuario;

      Serial.print("Requisição na URL: ");
      Serial.println(url);

      // MANDANDO REQUISIÇÃO
      client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
      //VERIFICA TEMPO
      unsigned long timeout = millis();
      while (client.available() == 0) {
          if (millis() - timeout > 5000) {
              Serial.println(">>> tempo !");
              client.stop();
              return;
          }
      }

      // SERIAL PRINT
      while(client.available()) {
          String line = client.readStringUntil('\r');
          //Serial.print(line);

          Serial.println();
          if (line.indexOf("Salvo_com_sucesso")!= -1){
            Serial.println("Salvo com sucesso");
          }else if(line.indexOf("erro_ao_salvar")!= -1){
            Serial.println("Ocorreu um erro");
          }
      }

      Serial.println();
      Serial.println("conexão fechada");

  }else{
      Serial.println();
      Serial.println("Sem necessidade de salvar no Banco");
  }
}

// ESTE METODO DEFINE A LOGICA DO LEDS E DAS INFORMAÇÕES OBTIDAS
void logicaLed(){
  if (sensor >= 0 && sensor <= 400){//solo encharcado, acende vermelho.
    estado="Encharcado";
    grauPerigo="Alto";
    Serial.println(" Estado do solo: "+(String)estado);
    digitalWrite(ledVermelho, HIGH);
    digitalWrite(ledVerde, LOW);
    digitalWrite(ledBranco, LOW);
    Serial.println("LED: Vermelho Ativo");
  }else if (sensor > 400 && sensor <= 800){//Solo umido, acende led branco.
    estado="Umido";
    grauPerigo="Medio";
    Serial.println(" Estado do solo: "+(String)estado);
    digitalWrite(ledVermelho, LOW);
    digitalWrite(ledVerde, LOW);
    digitalWrite(ledBranco, HIGH);
    Serial.println("LED: Branco Ativo"); 
  }
  else if (sensor > 800 && sensor <= 1024){//Solo seco, acende led verde.
    estado="Seco";
    grauPerigo="Baixo";
    Serial.println(" Estado do solo: "+(String)estado);
    digitalWrite(ledVermelho, LOW);
    digitalWrite(ledVerde, HIGH);
    digitalWrite(ledBranco, LOW);
    Serial.println("LED: Verde Ativo");
  }
}


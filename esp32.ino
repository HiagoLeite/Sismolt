/*
PARA O DESENVOLVIMENTO DO PROJETO FOI UTILIZADO 2 BIBLIOTECAS SENDO "WiFi.h" 
BIBLIOTECA DA IDE ARDUINO E "ESP32_MailClient.h" SENDO UMA LIB 
DISPONIBILIZADA NO GITHUB(PARA O USO DESSA EU DEIXEI A LICENÇA ABAIXO). PARA A QUESTÃ DE REQUISIÇÃO
EU UTILIZEI UM EXEMPLO QUE APROPRIA IDE ARDUINO DISPONIBILIZA.

(LICENÇA DA LIB "ESP32_MailClient.h")
The MIT License (MIT)

Copyright (c) 2021 K. Suwatchai (Mobizt)

Permission is hereby granted, free of charge, to any person returning a copy of 
this software and associated documentation files (the "Software"), to deal in the Software 
without restriction, including without limitation the rights to use, copy, modify, merge, 
publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to 
whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or 
substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR 
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE 
SOFTWARE.
LINK-https://github.com/mobizt/ESP-Mail-Client

Foi colocado este aviso acima devido ao  copyright, tendo em mente o uso da biblioteca 
disponibilizada pelo mesmo.
*/

#include "WiFi.h"
#include "ESP32_MailClient.h"

//INSERÇÃO DA CONTA E SENHA DO ESP32
#define contaRemetente "@gmail.com"
#define senhaRemetente ""
//INSERÇÃO DA CONTA DO DESTINATARIO(RECEBE EMAIL DO ESP)
#define emailDestinatario "@hotmail.com"
//INSERÇÃO DAS CONFIGURAÇÕES DO SMTP(CONFIG PARA CONTAS GMAIL)
#define smtpServer "smtp.gmail.com"
#define smtpServerPort 465
//ASSUNTO DO EMAIL
#define emailAssunto "Estado alarmante!"
//OBJ QUE CONTÉM DADOS PARA O ENVIO.
SMTPData smtpData;

const char* ssid = "nome rede";
const char* password = "senha";
const char* host = "xxxxxxx";//ip ou site sem .ext

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
      if(contPerigo==100){
        //METODO PARA MANDAR EMAIL AVISANDO DO PERIGO        
        mandarEmail();
        contPerigo=0;
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

void mandarEmail(){   
  //DEFINI O HOST DO SERVER, A PORTA DO SERVER, EMAIL E SENHA. 
  smtpData.setLogin(smtpServer, smtpServerPort, contaRemetente, senhaRemetente);
  //DEFENI O NOME DO REMETENTE
  smtpData.setSender("SISMOLT", contaRemetente);
  //PRIORIDADE ( VARIA ENTRE LOW, 1,5) 
  smtpData.setPriority("High");
  //DEFINE O ASSUNTO
  smtpData.setSubject(emailAssunto);

  //MENSAGEM EM HTML.(PARAMETRO TRUE É UTILIZADO CASO SEJA MSG HTML, CASO TEXTO BRUTO FALSE)
  smtpData.setMessage("<div style=\"color:#054f77;\">"
  "<h1>Sensor de Umidade do solo</h1></div>"
  "<h2>Foi detectado um alto risco de deslizamento na sua propriedade !</h2>"
  "<br/><br/>"
  "<p>É recomendado que você saia da sua residencia e busque um abrigo seguro,"
  " ligue para <b>XXXX-XXXXX</b> e informe a sua situação</p>", true);

  //DEFINE O EMAIL DO DESTINATARIO
  smtpData.addRecipient(emailDestinatario);

    if (!MailClient.sendMail(smtpData)){
      Serial.println("Erro ao mandar email, " + MailClient.smtpErrorReason());
    }else{
    Serial.println("Email enviado com sucesso");
    }
    
  //LIMPA OS DADOS DA SMTPDATA
  smtpData.empty();
}
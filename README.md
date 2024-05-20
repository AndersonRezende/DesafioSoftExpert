# DesafioSoftExpert
Desafio técnico PHP

## Informações
<ul>
<li>O arquivo ".env.example" deve ser renomeado para ".env" e configurado conforme necessário.</li>
<li>Caso alguma informação do arquivo ".env" tenha sido alterada, é necessário alterar também no arquivo docker-compose.yml no serviço "postgres".</li>
</ul>

## Instalação
O processo de instalação é simples, com o docker e o docker compose previamente já configurados, 
basta apenas executar o seguinte passo a passo e a aplicação já estará de pé rodando 
através do seguinte host: http://localhost:8080/

```
$ git clone https://github.com/AndersonRezende/DesafioSoftExpert.git
$ cd DesafioSoftExpert/docker
$ docker compose up --build
```
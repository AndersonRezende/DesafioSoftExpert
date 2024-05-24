# DesafioSoftExpert
Desafio técnico PHP

## Informações
<ul>
<li>O arquivo ".env.example" deve ser renomeado para ".env" e configurado conforme necessário.</li>
</ul>

## Requisitos
O único requisito é possuir um ambiente com Docker e Docker Compose configurado. 

Caso o não possua o docker e o docker-compose instalado, o mesmo pode ser configurado através da página oficial: https://docs.docker.com/engine/install/

Caso deseje mais praticidade e utilize alguma distro Linux baseada em Debian/Ubuntu, pode apenas baixar o seguinte script bash e executá-lo:
https://github.com/AndersonRezende/LinuxPostInstall/blob/master/scripts/9-docker.sh

```
$ curl https://github.com/AndersonRezende/LinuxPostInstall/blob/master/scripts/9-docker.sh -o docker.sh
$ sudo chmod +x docker.sh
$ ./docker.sh
```

## Execução
Com o docker e Docker Compose instalado, basta apenas seguir os seguintes tópicos:
<ul>
<li>Clonar o repositório.</li>
<li>Criar o arquivo .env (ou renomear o .env.example para .env) na raiz da pasta web.</li>
<li>Construir os containers com o docker compose.</li>
<li>Acessar a web no endereço: http://localhost:8080/</li>
</ul>

```
$ git clone https://github.com/AndersonRezende/DesafioSoftExpert.git
$ cd DesafioSoftExpert
$ mv web/.env.example web/.env
$ cd DesafioSoftExpert/docker
$ docker compose up --build
```

## Objetivos
Devido a limitação de tempo não foi possível implementar/melhorar uma série de aspectos da aplicação, por isso resolvi focar
em construir uma aplicação que tenta seguir alguns padrões das principais frameworks do mercado, como Laravel.

Evitei ao máximo utilizar bibliotecas e recursos extras focando unicamente na criação de toda a estrutura do zero.
Qualquer dúvida me coloco a disposição.

Resumindo, foquei em criar uma aplicação "Laravel like" do zero utilizando ambiente baseado em containers visando 
praticidade e facilidade de desenvolvimento e configuração e "autenticidade".
Por baixo dos panos é utilizado o banco de dados postgres, PHP-FPM e Nginx.
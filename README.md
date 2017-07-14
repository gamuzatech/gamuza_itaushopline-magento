<h1>Módulo do Itaú ShopLine</h1>

**Compatível com a plataforma Magento CE versão 1.6 a 1.9**

[Necessário módulo Gamuza_Utils](https://github.com/gamuzatech/gamuza_utils-magento)

Os seu clientes também podem pagar suas compras usando o método de pagamento mais comum em lojas virtuais.

Com o nosso módulo do Itaú ShopLine, você dispôe em sua loja virtual uma das formas de pagamentos mais utilizadas na internet.

Você ainda pode gerenciar as suas transaçôes, consultar os pagamentos e reemitir os boletos se necessário.

E não se preocupe com os anti-popup. Nós avisamos também os seus clientes sobre eles também... :)

<img src="https://dl.dropboxusercontent.com/s/kky7e8waci9v53q/gamuza-itaushopline-box.png" alt="" title="Gamuza Itaú ShopLine - Magento - Box" />

<h2>Instalação</h2>

<img src="https://dl.dropboxusercontent.com/s/pqpp0x62kqov683/sempre-faca-backup.png" alt="" title="Atenção! Sempre faça um backup da sua loja antes de realizar qualquer modificação!" />

**Instalar usando o modgit:**

    $ cd /path/to/magento
    $ modgit init
    $ modgit add gamuza_itaushopline https://github.com/gamuzatech/gamuza_itaushopline-magento.git

**Instalação manual dos arquivos**

Baixe a ultima versão aqui do pacote Gamuza_Itaushopline-xxx.tbz2 e descompacte o arquivo baixado para dentro do diretório principal do Magento

<img src="https://dl.dropboxusercontent.com/s/ir2vm6cyo3gl1v8/pos-instalacao.png" alt="Após a instalação, limpe os caches, rode a compilação, faça logout e login." title="Após a instalação, limpe os caches, rode a compilação, faça logout e login." />

**OBS: Após o cadastro junto ao Itaú, você deve aguardar 24hrs para começar a utilizar o ShopLine.**

<h2>Conhecendo o módulo</h2>

**1 - Selecionando o tipo de pagamento**

<img src="https://dl.dropboxusercontent.com/s/uqybmn82a1q5tan/gamuza-itaushopline-config-admin-1.png" alt="" title="Gamuza Itaú ShopLine - Magento - Configuração no Painel Administrativo" />

**2 - Preenchendo informações e ajustes**

<img src="https://dl.dropboxusercontent.com/s/5yp018r0b4nz9j8/gamuza-itaushopline-config-admin-2.png" alt="" title="Gamuza Itaú ShopLine - Magento - Configuração no Painel Administrativo" />

**3 - Selecionando disponibilidade para grupos específicos**

<img src="https://dl.dropboxusercontent.com/s/h8dsz1c7mv1xnkg/gamuza-itaushopline-config-admin-3.png" alt="" title="Gamuza Itaú ShopLine - Magento - Configuração no Painel Administrativo" />

**4 - Consultando e re-enviando transações**

<img src="https://dl.dropboxusercontent.com/s/3uou2xjqtul13h3/gamuza-itaushopline-transacoes-consulta-e-reenvio.png" alt="" title="Gamuza Itaú ShopLine - Magento - Consultando e re-enviando transações" />

**5 - Criando um pedido via painel administrativo**

<img src="https://dl.dropboxusercontent.com/s/av5egnp4w6vu9j1/gamuza-itaushopline-criar-pedido-admin.png" alt="" title="Gamuza Itau ShopLine - Magento - Criando um Pedido via Painel Administrativo" />

**6 - Consultando um pedido no painel administrativo**

<img src="https://dl.dropboxusercontent.com/s/l36xji0dfcxfvam/gamuza-itaushopline-consulta-pedido-admin.png" alt="" title="Gamuza Itau ShopLine - Magento - Consultando um pedido no painel administrativo" />

**7 - Criando um pedido na loja**

<img src="https://dl.dropboxusercontent.com/s/cho3hc4rcj9kd0t/gamuza-itaushopline-criar-pedido-loja.png" alt="" title="Gamuza Itaú ShopLine - Magento - Criando um Pedido na Loja" />

**8 - Aviso de anti-popup no navegador**

<img src="https://dl.dropboxusercontent.com/s/gpisy1dcr8saast/gamuza-itaushopline-aviso-antipopup.png" alt="" title="Gamuza Itaú ShopLine - Magento - Aviso de anti-popup no navegador" />

**9 - Página de Sucesso do Pedido**

<img src="https://dl.dropboxusercontent.com/s/x9n5d2zzexprdvh/gamuza-itaushopline-pagina-sucesso-pedido.png" alt="" title="Gamuza Itaú ShopLine - Magento - Página de Sucesso do Pedido" />

**10 - Re-enviando um pedido na loja**

<img src="https://dl.dropboxusercontent.com/s/ptr1w60mdgri7k0/gamuza-itaushopline-reenviando-pedido-loja.png" alt="" title="Gamuza Itaú ShopLine - Magento - Re-enviando um pedido na loja" />

<h2>Perguntas Frequentes</h2>

**- Recebi a mensagem: Não foi possível gerar o código de transação para envio. Verifique as suas configurações**

Essa mensagem de erro aparece devido a configurações incorretas em sua loja.

Por favor, verifique:

- Código do Itaú Shopline (Devem estar em letras maiúsculas)
- Chave do Itaú Shopline (Devem estar em letras maiúsculas)
- Dias para expiração do boleto
- Campo de CPF ou CNPJ do cliente (obrigatório).
- Campos de Endereço e Bairro (Deve ter 2 campos para endereço configurados no painel administrativo)
- Campos de CEP, Cidade e Estado.

A URL de retorno deve conter um endereço seguro para uma página de sucesso de sua loja.

Ex: https://www.minhaloja.com.br/checkout/onepage/success

**OBS: Após o cadastro junto ao Itaú, você deve aguardar 24hrs para começar a utilizar o ShopLine.**

**********************************************************************************************

**- O botão PAGAR não está sendo exibido na página de sucesso**

Você usa algum tema customizado em sua loja? Talvez isso pode estar ocasionando o seu problema...

Tente copiar os arquivos do tema default para o seu tema:

    app/design/frontend/base/default/layout/gamuza/utils.xml
    app/design/frontend/base/default/template/gamuza/utils
    app/design/frontend/base/default/template/gamuza/itaushopline

Para:

    app/design/frontend/pacote/tema/layout/gamuza/utils.xml
    app/design/frontend/pacote/tema/template/gamuza/utils
    app/design/frontend/pacote/tema/template/gamuza/itaushopline

**********************************************************************************************

**Capturando o Retorno**

O endereço para Retorno do Tipo de Pagamento será composto da seguinte maneira:

HTTPS:// + URL de Retorno Cadastrada + URLRetorna do Pedido + parâmetros de retorno criptografados.

Exemplo:

URL de Retorno cadastrada no Módulo Itaú Shopline = http://www.minhaloja.com.br
URL de retorno passada pelo lojista no pedido em questão = /final/retorno.php
Dados de retorno criptografados=?DC=A345B456F456W456T56J3K678

Exemplo da chamada à URL final:

https://www.minhaloja.com.br/final/retorno.php?DC=A345B456F456W456T56J3K678

A página de retorno do pagamento deve receber os dados criptografados e chamar o método decripto, e, para acessar o conteúdo de cada campo é necessário usar os métodos que retornam seus conteúdos:

- CodEmp - Código da Empresa ou Código do Site - Alfanumérico de 26 posições
- Pedido - Numero do Pedido - Numérico com 8 posições
- TipPag - Tipo de pagamento escolhido pelo comprador - Numérico com 2 posições:
01 para Pagamento à Vista (TEF ou CDC)
02 para Boleto
03 para Cartão Itaucard


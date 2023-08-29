O backend foi feito em Laravel e se encontra na pasta _api_.
O front foi feito em Vue com auxílio de Tailwind e se encontra na pasta _front_.

####Para rodar a api.
* Na pasta _api_ altere o _.env_ do projeto para o banco desejado.
* Entre na pasta _api_ e rode o comando de migração do banco: _php artisan migrate_
* Após a migração use o comando: _php artisan serve --port=8000_

Para rodar o front.
* Entre na pasta front e rode o comando: _npm install_
* Utilize o seguinte comando para iniciar o front: _npm run dev_
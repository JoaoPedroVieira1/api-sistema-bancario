CREATE TABLE clientes(
	id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
	endereco VARCHAR(255) NOT NULL
);

CREATE TABLE conta(
	id_conta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    numero_conta INT NOT NULL,
    tipo_conta VARCHAR(50) NOT NULL CHECK(tipo_conta IN('corrente', 'poupança')),
    saldo INT NOT NULL
)

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/16/2018
 * Time: 2:52 PM
 */

class RequestLogService implements RequestLogDAO {

    public static function save(RequestLog $log) {
        $db = null;
        try {
            $db = CustomPDO::getInstance();
            $db->beginTransaction();

            $sql = "CREATE TABLE IF NOT EXISTS request_log (
                id_log INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                sender_ip_adress varchar(50) NOT NULL,
                request_time DATETIME,
                request_method VARCHAR(10) NOT NULL,
                request_uri VARCHAR (50) NOT NULL,
                request_params VARCHAR(255) NOT NULL,
                request_authorization VARCHAR (255) NOT NULL,
                request_response TEXT,
                response_code INT NOT NULL
            )";

            $db->exec($sql);

            $sql = "INSERT INTO request_log 
                          VALUES(NULL, :ipAdress, NOW(), :method, :uri, :params, :reqAuth, :response, :code)";
            $pdoStatement = $db->prepare($sql);

            $pdoStatement->bindValue(":ipAdress", $log->getSenderIpAdress(), PDO::PARAM_STR);
            $pdoStatement->bindValue(":method", $log->getRequestMethod(), PDO::PARAM_STR);
            $pdoStatement->bindValue(":uri", $log->getRequestUri(), PDO::PARAM_STR);
            $pdoStatement->bindValue(":params", $log->getRequestParams(), PDO::PARAM_STR);
            $pdoStatement->bindValue(":reqAuth", $log->getRequestAuthorization(), PDO::PARAM_STR);
            $pdoStatement->bindValue(":response", $log->getResponse(), PDO::PARAM_LOB);
            $pdoStatement->bindValue(":code", $log->getResponseCode(), PDO::PARAM_INT);

            $pdoStatement->execute();

            $db->commit();
        } catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }

}
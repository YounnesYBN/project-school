<?php
class Commands{
    public int $id_for;
    public int $id_med;
    public int $id_par;
    public int $qte;
    public float $totale;
    public string $status;

    public function __construct(int $id_for,int $id_med, int $id_par,int $qte,float $totale,string $status){
        $this->id_for=$id_for;
        $this->id_med=$id_med;
        $this->id_par=$id_par;
        $this->qte=$qte;
        $this->totale=$totale;
        $this->status=$status;
    }


    public function connect_db(){
        
            try{
                $username="root";
                $passwordc='';
                $dsn='mysql:host=localhost;dbname=projet_db;port=3306;charset=utf8';
                $db= new PDO($dsn,$username,$passwordc);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
    
            } catch (PDOException $e){
                return false ;
            }
        }
    public function get_all_command_encour($database){
        $arrayencor=array();
        $quiry=$database->exec('SELECT id_for as "id_for",fornesseur.username as "fornesseur",id_par as "id_par",pharmaci.intitul as "pharmaci",id_med as "id_med",medicament.nom as "medecament", qte as"qte",totale as "totale",command_status as "status"
        from commande c,fornesseur f,mdicament m,pharmaci p
        where c.id_for=f.id_for AND c.id_med=m.id_med AND c.id_par=p.id_par AND
        command_status="en_coure"');
        while($result=$quiry->fetch()){
            $arrayencor[]=["id_for" => $result["id_for"],"fornisseur"=>$result["fornesseur"],
            "id_par" =>$result["id_par"],"pharmaci"=> $result["pharmaci"],
            "id_med"=>$result["id_med"],"medecament"=>$result["medicament"],
            "qte"=>$result["qte"],
            "totale"=>$result["totale"],
            "status"=>$result["status"]];
        }

        return $arrayencor;

    }
    public function get_all_command_refusee($database){
        $arrayrefuse=array();
        $quiry=$database->exec('SELECT id_for as "id_for",fornesseur.username as "fornesseur",id_par as "id_par",pharmaci.intitul as "pharmaci",id_med as "id_med",medicament.nom as "medecament", qte as"qte",totale as "totale",command_status as "status"
        from commande c,fornesseur f,mdicament m,pharmaci p
        where c.id_for=f.id_for AND c.id_med=m.id_med AND c.id_par=p.id_par AND
        command_status="refusee"');
        while($result=$quiry->fetch()){
            $arrayrefuse[]=["id_for" => $result["id_for"],"fornisseur"=>$result["fornesseur"],
            "id_par" =>$result["id_par"],"pharmaci"=> $result["pharmaci"],
            "id_med"=>$result["id_med"],"medecament"=>$result["medicament"],
            "qte"=>$result["qte"],
            "totale"=>$result["totale"],
            "status"=>$result["status"]];
        }

        return $arrayrefuse;
    }
    public function get_all_command_annule($database){
        $arrayrannule=array();
        $quiry=$database->exec('SELECT id_for as "id_for",fornesseur.username as "fornesseur",id_par as "id_par",pharmaci.intitul as "pharmaci",id_med as "id_med",medicament.nom as "medecament", qte as"qte",totale as "totale",command_status as "status"
        from commande c,fornesseur f,mdicament m,pharmaci p
        where c.id_for=f.id_for AND c.id_med=m.id_med AND c.id_par=p.id_par AND
        command_status="annule"');
        while($result=$quiry->fetch()){
            $arrayrannule[]=["id_for" => $result["id_for"],"fornisseur"=>$result["fornesseur"],
            "id_par" =>$result["id_par"],"pharmaci"=> $result["pharmaci"],
            "id_med"=>$result["id_med"],"medecament"=>$result["medicament"],
            "qte"=>$result["qte"],
            "totale"=>$result["totale"],
            "status"=>$result["status"]];
        }

        return $arrayrannule;
    }
    

}


?>
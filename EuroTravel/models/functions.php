<?php
    function dohvatiKorisnika($email, $sifrovanaLozinka){
        global $conn;

        $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.id_uloga=u.id_uloga WHERE k.email = :email AND k.lozinka = :lozinka";

        $priprema = $conn->prepare($upit);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':lozinka', $sifrovanaLozinka);
        $priprema->execute();

        $rezultat = $priprema->fetch();
        return $rezultat;

    }

    function dohvatiSve($nazivTabele){
        global $conn;

        $upit = "SELECT * FROM $nazivTabele";
        $podaci = $conn->query($upit)->fetchAll();
        
        return $podaci;
    }
    define('PRODUCT_OFFSET', 3);
    function prikaziProizvode($limit=0){
        global $conn;

      
        $query="SELECT * FROM proizvod p JOIN brend b ON p.id_brend=b.id_brend JOIN kategorija k ON p.id_kategorija=k.id_kategorija LIMIT :limit, :offset";

        $select=$conn->prepare($query);

       
        $limit=((int) $limit)*PRODUCT_OFFSET;
        
        $select->bindParam(":limit",$limit,PDO::PARAM_INT);

        $offset=PRODUCT_OFFSET;
        $select->bindParam(":offset",$offset,PDO::PARAM_INT);

        $select->execute();
        $result=$select->fetchAll();
        return $result;
        

    }

    function vratiPoslednjuCenu($idProizvoda){
        global $conn;

        $query="SELECT * FROM cenovnik WHERE id_proizvod = :id ORDER BY datum desc LIMIT 0,1";

         $select=$conn->prepare($query);

         $select->bindParam(":id",$idProizvoda);

         $select->execute();
        $result=$select->fetch();
        return $result;

    }

    function vratiBrojProizvoda(){
        global $conn;

        $query="SELECT COUNT(*) AS broj_proizvoda FROM proizvod p JOIN brend b ON p.id_brend=b.id_brend JOIN kategorija k ON p.id_kategorija=k.id_kategorija";

        $broj=$conn->query($query)->fetch();
        return $broj;
    }
    function vratiBrojStranice(){
        $brojProizvodaObj=vratiBrojProizvoda();

        $brojStranica=ceil($brojProizvodaObj->broj_proizvoda/PRODUCT_OFFSET);
        return $brojStranica;
    }
    
?>
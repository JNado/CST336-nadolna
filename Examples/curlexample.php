<?php
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/6PzdMzQHGfzqkdbMnjk3Nf");

        // //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'Authorization: Bearer BQAWBLQ2in-JgdzASuvj3H4NSahnqeMGTx4TIElQWV4aBQff-XRJskfsOMGVbC_7mxkPbf8RZsULA7xzaDWVe4QR4znV4oLXSHIG08XZH1D-YnD-D0EkWDZoEFyxH5axe9_SW54nf1mwvqxM71V-eoy5Vzk')); 
        
        // $output contains the output string
        $output = curl_exec($ch);
        
        // echo $output;
        $outData = json_decode($output);
        
        var_dump($output);
        // close curl resource to free up system resources
        curl_close($ch);     
?>
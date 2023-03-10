<?php

//CÁLCULO

function values(int $cad1, int $cad2, int $cad3, float $value, int $cad_time) {
    
    if ($cad_time <= $cad1) {
        $conn_value=0;    
        
        return $conn_value;
    
    } else {
        
        if ($cad_time <= $cad2) {
            $conn_value = ($value*$cad2)/60;
            
            return $conn_value;
        
        } else {
            
            $conn_value = ($value*$cad_time)/60;

            return $conn_value;
            
        }
    }
}

/*

function franch_calc(int $franchise,int $time_sec) {
    if ($franchise > $time_sec) {
        $franchise = $franchise - $time_sec;
        $time_sec = 0; 
    } else {
        $franchise = $franchise - $time_sec;
        $time_sec = $time_sec - $franchise;
    }
    echo "Franquia atual: $franchise\n";
    echo "Tempo de chamada: $time_sec\n";

} */

//INFORMAÇÃO SOBRE BASE DE CÁLCULO DA CHAMADA

function information(int $cad1, int $cad2, int $cad3, float $value, int $time_sec) {
    
    return "        Cadência informada: $cad1 / $cad2 / $cad3 \n
        Valor por segundo: $value/segundo\n
        Tempo da chamada: $time_sec\n";
}

//RELATÓRIO GERAL

function report(float $total_value, int $total_time, int $i) {
    
    $ave_duration = ($total_time)/($i);
    //$franch_balance = $franchise - $total_time;

    return "        Duração média de chamadas: $ave_duration (s)\n
        Valor total da chamada: $total_value R$\n
        Tempo total de chamada: $total_time (s)\n";

    
}

//ENTRADA DE TEMPOS

function input_times(int $cad1, int $cad2, int $cad3) {

    $total_time = NULL;
    $total_value = NULL;
    $value=readline("Informe o valor da minutagem (c): \n");
    $number_conn=readline("Informe a quantidade de ligações: \n");
    //$franchise=readline("Informe a minutagem da franquia: \n");
    echo "\n";
    //$franchise = $franchise * 60;
    
    for ($i = 0; $i < $number_conn; $i++)  {
        do {
            $i++;
            $time_sec=readline("Informe o tempo total da $i ª chamada em segundos (s): \n");

            //franch_calc($franchise,$time_sec);

            system('clear');

            echo information($cad1,$cad2,$cad3,$value,$time_sec);

            echo "\n";

            $cad_time = $time_sec;
        
            if ($cad_time >= $cad2) {
                while ($cad_time % $cad3 !== 0) {
                    $cad_time++;
                    }
            }
            
            $end_value = values($cad1,$cad2,$cad3,$value,$cad_time);
            
            echo "O valor desta ligação é: $end_value R$\n";

            echo "O tempo tarifado é: $cad_time s\n";
            
            echo "\n";
            
            echo "###############################################\n";

            $i--;
            $total_time += $time_sec;
            $total_value += $end_value;
        } while ($time_sec <= 0);
    }

    echo "\n";

    echo report($total_value,$total_time,$i);
    echo "\n";
}

// ENTRADA GERAL

function input() {
    
    do {
        $cad1=readline("Informe a cadência X / X / X: \n");
    } while ($cad1 < 0);
    do {
        $cad2=readline("Informe a cadência $cad1 / X / X: \n");
    }while ($cad2 < $cad1);
    do {
        $cad3=readline("Informe a cadência $cad1 / $cad2 / X: \n");
    }while ($cad3 < 0);
    system('clear');
    
    input_times($cad1,$cad2,$cad3);

}


//INÍCIO DO CÓDIGO, INSERINDO CADÊNCIAS

do {
    $op=readline('Deseja iniciar/reiniciar o cálculo? (S/N): ');

echo "\n";
echo "############################## CALCULADORA DE CADÊNCIAS ##############################\n";
echo "\n";

echo input();
} while ($op == 'S');

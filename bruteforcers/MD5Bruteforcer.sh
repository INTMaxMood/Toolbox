#!/bin/bash                             
#                                       
# $md5cracker                           
# Author: FuRt3X                        
# Md5 online cracker using curl.        
#                                       
# ./md5cracker 8ff413668f71ab0ece595bc8ccb177be
#                                              
# [*] www.md5crack.com: xonw                   
# [*] md5.hashcracking:   xonw                 
# [*] md5.gromweb.com:   xonw                  
# [*] hashkiller.com:  xonw                    
#                                              
#                                              
#                                              
if [ "$#" -ne "1" ];                           
then                                           
  echo "$0 <md5 hash>"                         
  exit                                         
fi                                             

HASH=$1
LENGTH=$(echo "${#HASH}")

if [ "${LENGTH}" -ne "32" ];
then                        
  echo "Invalid md5"        
  exit                      
fi                          


function md5cracker()
{                    
                     
 SITE[1]="www.md5crack.com/crackmd5.php"
 SITE[2]="term=${HASH}&crackbtn=Crack+that+hash+baby%21" 
 curl -s -d "${SITE[2]}" "${SITE[1]}" | grep -qE 'Found:'

 if [ $? -eq 0 ];
 then            
   echo "[*] www.md5crack.com: `curl -s -d "${SITE[2]}" "${SITE[1]}" |
   grep -E 'Found:' | sed 's#[md5\(\|"\)]##g' | awk '{print $2}'`"    
 fi                                                                   


  SITE[3]="http://md5.hashcracking.com/search.php?md5=${HASH}"
  curl -s "${SITE[3]}" | grep -Eq 'Cleartext of [0-9a-f]{32} is'    
                                                                    
  if [ $? -eq 0 ];                                                  
  then                                                              
    echo "[*] md5.hashcracking:\                                    
   `curl -s "${SITE[3]}" |                                          
    awk '{print $5}'| sed 's#^[ \t]*##;s#[ \t]*$##'`"               
  fi                                                                


  SITE[4]="http://www.hashchecker.com/index.php?_sls=search_hash"
  SITE[5]="search_field=${HASH}&Submit=search"                   
  curl -s -d "${SITE[5]}" "${SITE[4]}" |                         
  sed 's#<[^>]*>##g'| grep -qE 'Your md5 hash is :'              

  if [ $? -eq 0 ];
  then            
    echo "[*] hashchecker: `curl -s -d "${SITE[5]}" "${SITE[4]}" |
    sed 's#<[^>]*>##g' | grep -E 'Your md5 hash is :' | awk '{print $7}'`"
  fi                                                                      


 SITE[6]="http://md5hood.com/index.php/cracker/crack"
 SITE[7]="hash=${HASH}&submit=Go"                    
 curl -s -d "${SITE[7]}" "${SITE[6]}" | grep -qE 'result_true' 

 if [ $? -eq 0 ];
 then            
   echo "[*] md5hood.com: `curl -s -d "${SITE[7]}" "${SITE[6]}" |
   grep -E 'result_true' | sed -e 's#<[^>]*>##g' |               
   sed -e 's#^[ \t]*##'`"                                        
 fi                                                              

 
  SITE[8]="http://md5online.net/"
  SITE[9]="pass=${HASH}&option=hash2text&send=Submit"
  curl -s -d "${SITE[9]}" "${SITE[8]}" |             
  sed 's#<[^>]*>##g' | grep -qE 'pass :'             

  if [ $? -eq 0 ];
  then            
    echo "[*] md5online.net: `curl -s -d "${SITE[9]}" "${SITE[8]}" | 
    sed 's#<[^>]*>##g' | grep -E 'pass :' | awk '{print $5}'`"       
  fi                                                                 


  SITE[10]="http://md5.drasen.net/search.php?query=${HASH}"
  curl -s "${SITE[10]}" | sed 's#<[^>]*># #g' | grep -qE 'Plain:' 
                                                                  
  if [ $? -eq 0 ];                                                
  then                                                            
    echo "[*] md5.drasen.net: `curl -s "${SITE[10]}" |            
    sed 's#<[^>]*># #g' | grep -E 'Plain:' | awk '{print $4}'`"   
  fi                                                              


  SITE[11]="http://md5.gromweb.com/query/${HASH}"
 curl -I -s "${SITE[11]}" | grep -qi 'OK'        
                                                 
 if [ $? -eq 0 ];                                
 then                                            
   echo "[*] md5.gromweb.com:\                   
   `curl -s "${SITE[11]}"`"                      
 fi                                              


 SITE[12]="http://md5-db.de/${HASH}.html"
 SITE[13]="md5=${HASH}"                  
 curl -s -d "${SITE[13]}" "${SITE[12]}" | 
 sed -e 's#<[^>]*>##g' | grep -qE 'verwenden:' 

 if [ $? -eq 0 ];
 then            
   echo "[*] md5-db.de:\
  `curl -s -d "${SITE[13]}" "${SITE[12]}" | 
   sed -e 's#<[^>]*>##g' | grep -E 'verwenden:' | awk -F':' '{print $2}'`"
 fi                                                                       


  SITE[14]="http://shell-storm.org/md5/"
  SITE[15]="summd5=${HASH}&Submit=Decrypt"
  curl -s -d "${SITE[15]}" "${SITE[14]}" | 
  grep -qE '[0-9a-f]{32}'                  

  if [ $? -eq 0 ];
  then            
    echo "[*] shell-storm.org:\
   `curl -s -d "${SITE[15]}" "${SITE[14]}" | 
    grep -E '[0-9a-f]{32}' | sed 's#<[^>]*># #g' | awk '{print $8}'`" 
  fi                                                                  

 
 SITE[16]="http://md5.thekaine.de/?hash=${HASH}"
 curl -s "${SITE[16]}" |                        
 grep -qEi '<br><br><b>not found</b></td><td></td>' 
                                                    
 if [ $? -eq 1 ];                                   
 then                                               
   echo "[*] md5.thekaine.de:\                      
  `curl -s "${SITE[16]}" |                          
   grep -Ei '<br><br><b>(.*)</b></td><td></td>' | sed 's#<[^>]*>##g'`"
 fi                                                                   


 SITE[17]="http://victorov.su/md5/?md5e=&md5d=${HASH}"
  curl -s "${SITE[17]}" | sed 's#<[^>]*>##g' | grep -qiE '^MD5'

  if [ $? -eq 0 ];
  then            
    echo "[*] victorov.su:\
   `curl -s "${SITE[17]}" |
    sed 's#<[^>]*>##g' | grep -iE '^MD5' | awk -F':' '{print $2}' | sed -e 's# ##'`"
  fi                                                                                


 SITE[18]="http://opencrack.hashkiller.com/"
 SITE[19]="oc_check_md5=${HASH}&oc_submit=Search+MD5"
 curl -s -d "${SITE[19]}" "${SITE[18]}" |            
 grep -qE '&lt;notfound&gt;'                         

 if [ $? -eq 1 ];
 then            
   echo "[*] hashkiller.com:\
  `curl -s -d "${SITE[19]}" "${SITE[18]}" |
   sed 's#<[^>]*>##g' | grep -E '[0-9a-f]{32}' | awk -F':' '{print $2}'`"
 fi                                                                      


 SITE[20]="http://passcracking.com/"
 SITE[21]="datafromuser=${HASH}&submit=DoIT"
 curl -s -d "${SITE[21]}" "${SITE[20]}" |   
 sed 's#<[^>]*># #g' | grep -qE 'md5 Database' 

 if [ $? -eq 0 ];
 then            
   echo "[*] passcracking.com:\
  `curl -s -d "${SITE[21]}" "${SITE[20]}" |
   sed 's#<[^>]*># #g' | grep -E 'md5 Database' | awk '{print $10}'`"
 fi                                                                  


 SITE[22]="http://rom-zone.alfahosting.org/index2.php?p=hashes"
 SITE[23]="typ=md5&list=${HASH}"                               
 curl -s -d "${SITE[23]}" "${SITE[22]}" |                      
 grep -qiE '<td>MD5<\/td><td>[0-9a-f]{32}<\/td><td>Geknackt<\/td><td>(.*)<\/td>'  

 if [ $? -eq 0 ];
 then            
   echo "[*] rom-zone.alfahosting.org:\
  `curl -s -d "${SITE[23]}" "${SITE[22]}" |   
   grep -iE '<td>MD5<\/td><td>[0-9a-f]{32}<\/td><td>Geknackt<\/td><td>(.*)<\/td>'| 
   sed 's#<[^>]*># #g' | awk '{print $6}'`"                                        
 fi                                                                                

  
 SITE[24]="http://md5decryption.com/"
 SITE[25]="hash=${HASH}&submit=Decrypt+It%21"
 curl -s -d "${SITE[25]}" "${SITE[24]}" |    
 grep -qiE "Decrypted Text:"                 

 if [ $? -eq 0 ];
 then            
   echo "[*] md5decryption.com:\
  `curl -s -d "${SITE[25]}" "${SITE[24]}" |
   grep -iE "Decrypted Text:" |            
   sed -e 's#<[^>]*>##g' -e 's#<!--##g' | awk '{print $5}'`"
 fi                                                         


  SITE[26]="http://md5-decrypter.com/"
  SITE[27]="data%5BRow%5D%5Bcripted%5D=${HASH}"
  curl -s -d "${SITE[27]}" "${SITE[26]}" |     
  sed 's#<[^>]*>##g' | grep -qE 'Decrypted text:' 

  if [ $? -eq 0 ]; 
  then             
    echo "[*] md5-decrypter.com:\
   `curl -s -d "${SITE[27]}" "${SITE[26]}" |
    sed 's#<[^>]*>##g' | grep -E 'Decrypted text:' |
    awk '{print $3}'`"                              
  fi                                                


 SITE[28]="http://www.bigtrapeze.com/md5/index.php"
 SITE[29]="query=${HASH}&+Crack+=Enviar+dados"     
 curl -s -d "${SITE[29]}" "${SITE[28]}" |          
 sed 's#<[^>]*># #g' | grep -qE 'has been deciphered to:'
                                                         
 if [ $? -eq 0 ];                                        
 then                                                    
   echo "[*] www.bigtrapeze.com:\                        
  `curl -s -d "${SITE[29]}" "${SITE[28]}" |              
   sed 's#<[^>]*># #g' | grep -E 'has been deciphered to:' |
   awk '{print $9}'`"                                       
 fi                                                         

 
 SITE[30]="http://md5.digitalsun.pl/"
 SITE[31]="hash=${HASH}"             
 curl -s -d "${SITE[31]}" "${SITE[30]}" | 
 grep -qE '<b>(.*)</b> == [0-9a-f]{32}<br>' 
                                            
 if [ $? -eq 0 ];                           
 then                                       
   echo "[*] md5.digitalsun.pl:\            
  `curl -s -d "${SITE[31]}" "${SITE[30]}" | 
   grep -E '<b>(.*)</b> == [0-9a-f]{32}<br>' |
   sed 's#<[^>]*>##g' | awk '{print $1}'`"    
 fi                                           

}


function banner()
{                
echo '           
####################################################################################
#             .___ .________                                 __                    #
#  _____    __| _/ |   ____/  ____  _______ _____     ____  |  | __  ____  _______ #
# /     \  / __ |  |____  \ _/ ___\ \_  __ \\__  \  _/ ___\ |  |/ /_/ __ \ \_  __ \#
#|  Y Y  \/ /_/ |  /       \\  \___  |  | \/ / __ \_\  \___ |    < \  ___/  |  | \/#
#|__|_|  /\____ | /______  / \___  > |__|   (____  / \___  >|__|_ \ \___  > |__|   #
#      \/      \/        \/      \/              \/      \/      \/     \/         #
# by: FuRt3X                                                                       #
####################################################################################

=> Md5 Online Cracker
=> FuRt3X ~> blkhtc0rp@yahoo.com.br

'
}

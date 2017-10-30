clear
#Author:Suraj Adsul
mqytime=`who -b`

flag=`echo $mqytime|awk '{print match($0,"14:")}' || '{print match($0,"12:")}'`;

if [ $flag -gt 0 ];then
punchin=`date +%I:%M`
date +%I:%M%p
echo "$punchin"
sendEmail -f email@email.com-t email@email.com-cc email@email.com-u [Punch-In] $punchin -m Thanks, -s smtp.mail.yahoo.com -xu email@email.com-xp password		
    echo "Success";
else
    echo "fail";
fi
exit 0


sendEmail -f email@email.com-t email@email.com-cc email@email.com-u [Punch-In] 45646 -m Thanks, -s smtp.mail.yahoo.com -xu email@email.com-xp		

sendemail -f fromuser@gmail.com -t touser@domain.com -u subject -m "message" -s smtp.gmail.com -o tls=yes -xu gmailaccount -xp gmailpassword

echo "Testing" | mail -s "Test Email" email@email.com

sendEmail -f email@email.com-t email@email.com-cc email@email.com-u [Punch-In] 45646 -m Thanks, -s smtp.gmail.com -xu email@email.com -xp Mobile@123		

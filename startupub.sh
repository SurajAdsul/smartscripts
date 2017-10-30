#Author:Suraj Adsul
clear
mqytime=`who -b`

flag=`echo $mqytime|awk '{print match($0,"13:")}' || '{print match($0,"12:")}'`;

if [ $flag -gt 0 ];then

    echo "Success";
else
    echo "fail";
fi
exit 0

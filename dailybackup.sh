clear
sleep 150
punchin=`date +%Y-%m-%d`
if [  -d /media/team/853c9adc-7ef2-4a4a-96d5-e30c3b69f72d/$punchin ] ; then
echo "exists"
else 
mkdir /media/team/853c9adc-7ef2-4a4a-96d5-e30c3b69f72d/$punchin
cp -a /var/www/html/painManagement /media/team/853c9adc-7ef2-4a4a-96d5-e30c3b69f72d/$punchin
fi
exit 0


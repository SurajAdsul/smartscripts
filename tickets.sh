STAGE
OUTPUT1="$(git status)"

STAGE2
OUTPUT2="$(git status)"

STAGE3
OUTPUT3="$(git status)"

STAGE4
OUTPUT4="$(git status)"

STAGE5
OUTPUT5="$(git status)"


opt1=$(echo "${OUTPUT1}" | grep -o -P '(?<=On branch ).*')
opt2=$(echo "${OUTPUT2}" | grep -o -P '(?<=On branch ).*')
opt3=$(echo "${OUTPUT3}" | grep -o -P '(?<=On branch ).*')
opt4=$(echo "${OUTPUT4}" | grep -o -P '(?<=On branch ).*')
opt5=$(echo "${OUTPUT5}" | grep -o -P '(?<=On branch ).*')

curl -X POST \
  https://hooks.slack.com/services/UYYYGVY/GFFDJ4524TT/AGgjiofshfejk88782 \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: c8828ad3-ebfa-738d-83c8-6ada2a01e839' \
  -d '{
    "text": "Tickets on stage servers:\nStage 1: '"$opt1"'\nStage 2: '"$opt2"'\nStage 3: '"$opt3"'\nStage 4: '"$opt4"'\nStage 5: '"$opt5"'"
}

 '

 exit
 ^c



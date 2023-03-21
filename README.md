Introduction to Laravel caching

Fetching List :  http://localhost:8000/api/quotes

Store Quote : 

curl -X POST -H 'Content-Type: application/json' -d '{
  "text": "If debugging is the process of removing software bugs, then programming must be the process of putting them in.",
  "name": "Edsger Dijkstra"
}' http://localhost:8000/api/quotes -i

static::saving(function() {
    Cache::forget('allQuotes');
});

Modify Quote :

curl -X PUT -H 'Content-Type: application/json' -d '{
  "text": "Sometimes123456789 it pays to stay in bed on Monday, rather than spending the rest of the week debugging Mondays code.",
  "name": "Dan Salomon"
}' http://localhost:8000/api/quotes/102 -i

static::updated(function(){
    Cache::forget('allQuotes');
});

Delete Quote :

curl -X DELETE http://localhost:8000/api/quotes/1 -i

static::deleted(function() {
    Cache::forget('allQuotes');
});
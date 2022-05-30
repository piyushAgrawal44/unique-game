



var all_chars=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']
// console.log(random);
var auto_word;
var char_16=[];
var word="";

automatic_words();

function automatic_words(){
    var level=1,url;
    if (level==1) {
        var random= Math.floor(Math.random() * 2)+4;

       if (random==4) {
        url="https://api.datamuse.com/words?sp=????";
       }
       else if(random==5){
        url="https://api.datamuse.com/words?sp=?????";
       }
       else{
        url="https://api.datamuse.com/words?sp=??????";
       }
    } 
    else if(level==2){
        var random= Math.floor(Math.random() * 3)+5;

        if (random==5) {
         url="https://api.datamuse.com/words?sp=?????";
        }
        else if(random==6){
         url="https://api.datamuse.com/words?sp=??????";
        }
        else if(random==7){
            url="https://api.datamuse.com/words?sp=???????";
           }
        else{
         url="https://api.datamuse.com/words?sp=????????";
        }
    }
    else {
        var random= Math.floor(Math.random() * 3)+7;

        if(random==7){
            url="https://api.datamuse.com/words?sp=???????";
        }
        else if(random==8){
            url="https://api.datamuse.com/words?sp=????????";
        }
        else if(random==9){
            url="https://api.datamuse.com/words?sp=?????????";
        }
        else{
         url="https://api.datamuse.com/words?sp=??????????";
        }
    }
    getWordApi(url);
}

function search(){
   
    word=document.getElementsByName('search')[0].value;
    
    if (word) {
        const api_url = "https://api.dictionaryapi.dev/api/v2/entries/en/"+word;
        getapi(api_url,word);
    } 
    else {
        alert("Please create a word");
    }
    clickNum=2;
    const myTimeout = setTimeout(computer_turn, 5000); 
    
}

function computer_turn(){
    document.getElementById('alert').classList.add('d-none');
    document.getElementsByClassName('player1')[0].classList.remove('active');
    document.getElementsByClassName('player2')[0].classList.add('active');

    const myTimeout = setTimeout(()=>{
      
        document.getElementsByName('search')[0].value=auto_word;
        var player1_score=document.getElementsByName('player1_score')[0].innerText;
        document.getElementsByName('player1_score')[0].innerText=player1_score-auto_word.length*20;
        // alert("Well done player 2");
        document.getElementById('alert').classList.remove('d-none');
        document.getElementById('damage_from').innerText="Player 2";
        document.getElementById('damage_to').innerText="Player 1";
        document.getElementById('damage').innerText=auto_word.length*20;
        
        const myTimeout = setTimeout(player1_turn, 5000); 
    }, 2000);


    
}


async function getapi(url,word) {
    
    // Storing response
    const response = await fetch(url);
    
    // Storing data in form of JSON
    var data = await response.json();
    

    if (data.title) {
       alert('Wrong Word By Player 1');
       var player1_score=document.getElementsByName('player1_score')[0].innerText;
       document.getElementsByName('player1_score')[0].innerText=player1_score-10;
    } 
    else {
        // alert('Well Done Player 1');
        var player2_score=document.getElementsByName('player2_score')[0].innerText;
        document.getElementsByName('player2_score')[0].innerText=player2_score-word.length*20;
        document.getElementById('alert').classList.remove('d-none');
        document.getElementById('damage_from').innerText="Player 1";
        document.getElementById('damage_to').innerText="Player 2";
        document.getElementById('damage').innerText=word.length*20;
    }
}


function player1_turn(){

    var player1_score=document.getElementsByName('player1_score')[0].innerText;
    var player2_score=document.getElementsByName('player2_score')[0].innerText;

    if (player1_score>=player2_score) {
        alert("Round 2 win by Player 1");
        document.getElementsByName('round_win_by')[0].value=1;

    } else {
        alert("Round 2 win by Player 2");
        document.getElementsByName('round_win_by')[0].value=0;
    }
    word="";
    document.getElementsByName('search')[0].value="";
    document.querySelector(
        "body").style.visibility = "hidden";
    document.querySelector(
        "#next_round_form").style.visibility = "visible";
}

function addChar(char,index){
    word=word+char;
    document.getElementsByName('search')[0].value=word;
    document.getElementsByClassName(index)[0].setAttribute('disabled','disabled');
}
function cut(){

    var temp12=document.getElementsByName('search')[0].value;
    document.getElementsByClassName(temp12[temp12.length - 1])[0].removeAttribute('disabled','disabled');
    document.getElementsByName('search')[0].value= temp12.slice(0, temp12.length - 1);
    word=temp12.slice(0, temp12.length - 1);
  

}

async function getWordApi(url) {
    
    // Storing response
    const response = await fetch(url);
    
    // Storing data in form of JSON
    var data = await response.json();
    // console.log(data[0].word);

    auto_word=data[Math.floor(Math.random() * data.length)].word;
   
   
    var count=16-auto_word.length;
   
    var other_chars=[];
    var is_exist=true;
    for (let index2 = 0; index2 < all_chars.length; index2++) {

       for (let index3 = 0; index3 < auto_word.length; index3++) {
          if (all_chars[index2]==auto_word[index3]) {
                is_exist=false;
                break;
          }
       }
       if (is_exist==true) {
        other_chars.push(all_chars[index2]);
       }
       is_exist=true;
    }
    var required_chars=[...auto_word];
    other_chars.length=count;

    char_16 = required_chars.concat(other_chars);
    console.log(auto_word);
    console.log(char_16);
    var btns_row=document.getElementById("btns_row");
    for (var i = char_16.length - 1; i > 0; i--) {
   
        // Generate random number
        var j = Math.floor(Math.random() * (i + 1));
                    
        var temp = char_16[i];
        char_16[i] = char_16[j];
        char_16[j] = temp;
    }

    for(var index4=0;index4<=15;index4++){
        char=char_16[index4];
         var new_div1= document.createElement('div');
         new_div1.classList.add('col-3');
        //  new_div1.classList.add('border');
        //  new_div1.classList.add('border-dark');
        //  new_div1.classList.add('border-0');
         new_div1.classList.add('p-0');
         new_div1.classList.add('text-center');
         new_div1.id=index4;
         btns_row.append(new_div1);
 
         var btn_col=document.getElementById(index4);
         var new_button = document.createElement('button');
         new_button.type = 'button';
         new_button.classList.add('btn');
        //  new_button.classList.add('btn-primary');
         // new_button.classList.add('text-danger');
         new_button.classList.add('btnDimession');
         new_button.classList.add(index4);
         new_button.setAttribute('onclick', 'addChar("'+String(char)+'",'+index4+')');
         new_button.innerText=char;
         btn_col.append(new_button);
    }
}
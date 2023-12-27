const btnsShowAnswer = document.querySelectorAll(".btnsShowAnswer");
const answersForQuestion = document.querySelector("#answersForQuestion");
const idAuthorQuestion = document.querySelector('#idAuthorQuestion');
const idDateQuestion = document.querySelector('#idDateQuestion');
const idHeadingQuestion = document.querySelector('#idHeadingQuestion');
const idUpvoteValue=document.querySelector('#upvoteValueModal');
const btnAnswer = document.querySelector('#idBtnAnswer');
let selectedQuestion = "";
let btnsUpvoteAnswer;
let btnDownvoteAnswer;
const inputAnswer = document.querySelector('#inputAnswer');
const day=0; 
const month=1; 
const year=2; 
const hour=0; 
const minute=1; 
const second=2;
const date=0; 
const hours=1; 
function load() { 
  location.replace("https://www.w3schools.com")
}
function loadAnswerToModal(data) {
  data.forEach(element => {
    let strDateTime=element['created_at'].split(' ');
     
    let  dateFormat=strDateTime[date].split('-'); 
    let hoursFormat=strDateTime[hours];
    answersForQuestion.innerHTML += `
        <div class="answer row pb-5">
        <!-- phần avartar -->
        <div class="col-1">
          <div class="avatarQuestion">
          <img src="images/default.png" alt="err">

          </div>
          <!-- USER's Info -->
        </div>
        <div class="col-10">
          <div class="authorAnswer">
            ${element["firstname"]} ${element["lastname"]}
          </div>
          <div class="dateAnswer">
            ${
              dateFormat[day]+"/"+dateFormat[month]+"/"+dateFormat[year]+" "+hoursFormat
            }
          </div>
    
        </div>
        <!--  CONTENT -->
        <div class="contentAnswer pt-1 ps-4">
            ${element["content"]} 
        </div>
        <!-- Vote -->
        <div class="featureAnswer mt-4" id="updownvote-answer${element["id_answer"]}">
          <button class="btn btn-outline-purple-nohover py-1 d-inline btnsUpVote btnsUpVoteAnswer ${(element['type']==='upvote'?'active':'') }" data-id-answer="${element["id_answer"]}">
            <p class="m-0"><i class="fa fa-angle-up text-purple" aria-hidden="true"></i>
              Upvote <span class="upvoteValue"> ${element["upvote"]}
              </span></p>
          </button>
          <button class="btn btn-outline-purple-nohover py-1 btnsDownVote btnsDownVoteAnswer ${element['type']=='downvote'?'active':''}" data-id-answer="${element["id_answer"]}">
            <p class="m-0"><i class="fa fa-angle-down text-purple " aria-hidden="true"></i>
            </p>
          </button>
        </div>
      </div>
        
        
        
        
        
        
        
        
        
        `;
  });
  btnsUpvoteAnswer = document.querySelectorAll(".btnsUpVoteAnswer");
  btnDownvoteAnswer = document.querySelectorAll(".btnsDownVoteAnswer");

  btnsUpvoteAnswer.forEach(element => {
    element.addEventListener('click', () => {
          //thêm class vào nút hiện tại để thay nền 
          element.classList.toggle("active");

          //hủy class của nút DownVote nếu đã ấn 
          const btnUpDownVoteBlock = document.querySelector("#updownvote-answer" + element.getAttribute('data-id-answer'));
          const btnDownVote = btnUpDownVoteBlock.querySelector(".btnsDownVote");
          if (btnDownVote.classList.contains('active')) {
              btnDownVote.classList.remove('active');
          }

          //Chuẩn bị data gửi lên server 
          const data= {'action':'upvote',"id_answer":element.getAttribute('data-id-answer')}; 

          //gửi dữ liệu lên server  
          async function IncreaseUpvote() { 
            const respone=await fetch('../api/vote-answer.php',
            {method:'POST',
             headers:{'Content-Type':'application/json'},
             body: JSON.stringify(data)
            }); 

            if(respone.ok) { 
              const res=await respone.json(); 
              const valueOfUpvote=btnUpDownVoteBlock.querySelector('.upvoteValue');
              valueOfUpvote.textContent=res['upvote'];

            }

          }

          IncreaseUpvote(); 

        }
    )
  }
  )

  btnDownvoteAnswer.forEach(element => {
    element.addEventListener('click', () => {
          //thêm class vào nút hiện tại để thay nền 
          element.classList.toggle("active");

          //hủy class của nút DownVote nếu đã ấn 
          const btnUpDownVoteBlock = document.querySelector("#updownvote-answer" + element.getAttribute('data-id-answer'));
          const btnDownVote = btnUpDownVoteBlock.querySelector(".btnsUpVote");
          if (btnDownVote.classList.contains('active')) {
              btnDownVote.classList.remove('active');
          }

          //Chuẩn bị data gửi lên server 
          const data= {'action':'downvote',"id_answer":element.getAttribute('data-id-answer')}; 

          //gửi dữ liệu lên server  
          async function DecreaseUpvote() { 
            const respone=await fetch('../api/vote-answer.php',
            {method:'POST',
             headers:{'Content-Type':'application/json'},
             body: JSON.stringify(data)
            }); 

            if(respone.ok) { 
              const res=await respone.json(); 
              const valueOfUpvote=btnUpDownVoteBlock.querySelector('.upvoteValue');
              valueOfUpvote.textContent=res['upvote'];

            }

          }

          DecreaseUpvote(); 
    }
    )
  }
  )



}
//Hiển thị câu hỏi khi ấn vào và load câu trả lời 
btnsShowAnswer.forEach(element => {
  element.addEventListener('click', () => {
    selectedQuestion = element.getAttribute('data-id-question');

    const questionInfo = document.querySelector("#idQuestion" + element.getAttribute('data-id-question'));

    //Hiển thị thông tin lên modal 
    idAuthorQuestion.textContent = questionInfo.querySelector('.authorQuestion').textContent;
    idDateQuestion.textContent = questionInfo.querySelector('.dateQuestion').textContent;
    idHeadingQuestion.textContent = questionInfo.querySelector('.contentQuestion').textContent;
    idUpvoteValue.textContent=questionInfo.querySelector('#upvoteValue').textContent; 
    answersForQuestion.innerHTML = "";
    //lấy câu trả lời của câu hỏi từ server 
    async function GetAnswer() {
      const implement = await fetch('../api/answer.php?action=get-all-answers&id='+element.getAttribute('data-id-question'), {
        method: "GET",
        header: { 'Content-Type': 'application/json' },
      });

      if (implement.ok) {
        const data = (await implement.json());
        if (data.length) {
          console.log(data);
          loadAnswerToModal(data);
        }
      }
    }

    GetAnswer();

  });
});
//Ấn để trả lời  
btnAnswer.addEventListener('click', () => {
  //chuẩn bị dữ liệu gửi lên server 
  if (selectedQuestion != "") {
    const data = {
      "id_question": selectedQuestion,
      "content": inputAnswer.value
    };
    answersForQuestion.innerHTML = "";
    inputAnswer.value = "";
    async function PostAnswer() {
      const respone = await fetch('../api/send-answer.php', {
        headers: { "Content-Type": "Application/json" },
        method: "POST",
        body: JSON.stringify(data)
      });

      if (respone.ok) {
        const data = await respone.json();
        loadAnswerToModal(data);

      }

    }

    PostAnswer();

  }



});
/* 
  "id_answer": 21,
        "author": "nhan",
        "content": "",
        "created_at": "2023-12-22",
        "edited_at": "2023-12-22",
        "status": "answer",
        "id_question": 23,
        "upvote": 0,
        "downvote": 0,
        "firstname": "nhan",
        "lastname": "nhan"
*/


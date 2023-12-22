const btnsShowAnswer = document.querySelectorAll(".btnsShowAnswer");
const answersForQuestion=document.querySelector("#answersForQuestion"); 
const idAuthorQuestion=document.querySelector('#idAuthorQuestion'); 
const idDateQuestion=document.querySelector('#idDateQuestion'); 
const idHeadingQuestion=document.querySelector('#idHeadingQuestion'); 
const btnAnswer=document.querySelector('#idBtnAnswer'); 
let selectedQuestion=""; 
const inputAnswer=document.querySelector('#inputAnswer'); 

//Hiển thị câu hỏi khi ấn vào và load câu trả lời 
btnsShowAnswer.forEach(element => {
    element.addEventListener('click', () => {
        selectedQuestion=element.getAttribute('data-id-question'); 
        const data = { "id_question": element.getAttribute('data-id-question'),
    }       
        const questionInfo=document.querySelector("#idQuestion"+element.getAttribute('data-id-question'));

        //Hiển thị thông tin lên modal 
        idAuthorQuestion.textContent=questionInfo.querySelector('.authorQuestion').textContent; 
        idDateQuestion.textContent=questionInfo.querySelector('.dateQuestion').textContent; 
        idHeadingQuestion.textContent=questionInfo.querySelector('.contentQuestion').textContent; 
        answersForQuestion.innerHTML="";
        //lấy câu trả lời của câu hỏi từ server 
        async function GetAnswer() {
            const implement = await fetch('../api/answer.php', {
                method: "POST",
                header: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if(implement.ok) { 
                const data=(await implement.json());
                const reserve=data.reverse(); 
                if(reserve.length) { 
                    reserve.forEach(element => {
                        answersForQuestion.innerHTML+="<h5>"+element["id_answer"]+"</h5>"; 
                    });
                }
            }
        }

        GetAnswer(); 

    });
});  

//Ấn để trả lời  
btnAnswer.addEventListener('click',() =>{
    //chuẩn bị dữ liệu gửi lên server 
    if(selectedQuestion!="") { 
        const data= { 
            "id_question":selectedQuestion, 
            "content": inputAnswer.textContent
        }; 
        answersForQuestion.innerHTML=""; 
        inputAnswer.value=""; 
        async function PostAnswer() { 
            const respone=await fetch('../api/send-answer.php',{
                headers:{"Content-Type":"Application/json"}, 
                method:"POST",
                body:JSON.stringify(data) 
            }); 

            if(respone.ok) { 
                const data=await respone.json(); 
                const reserve=data.reverse(); 
                reserve.forEach(element => {
                        answersForQuestion.innerHTML+="<h5>"+element["id_answer"]+"</h5>"; 
                    });
                
            }
            
        }

        PostAnswer(); 

    }    



}); 



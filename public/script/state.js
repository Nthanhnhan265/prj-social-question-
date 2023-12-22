/*
State of buttons, icons etc 

*/
//phương thức truyền vào url,data để gửi về server, return promise 
const post = (url, data) => {
    return fetch(url, {
        method: 'POST',
        header: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });
}
//lấy ra tất cả element có class 
const btnsUpVote = document.querySelectorAll(".btnsUpVote");
const btnsDownVote = document.querySelectorAll(".btnsDownVote");
const btnsBookmark = document.querySelectorAll(".btnsBookmark");
const pathIcons8 = "https://img.icons8.com/windows/50/";
// alert(btnsBookmark); 
//duyệt for cho nút Upvote 
btnsUpVote.forEach((element, index) => {
    element.addEventListener('click', () => {
        //thêm class vào nút hiện tại để thay nền 
        element.classList.toggle("active");

        //hủy class của nút DownVote nếu đã ấn 
        const btnUpDownVoteBlock = document.querySelector("#updownvote" + element.getAttribute('data-id-question'));
        const btnDownVote = btnUpDownVoteBlock.querySelector(".btnsDownVote");
        if (btnDownVote.classList.contains('active')) {
            btnDownVote.classList.remove('active');
        }
        //chuẩn bị dữ liệu gửi lên server 
        const data = {
            "id_question": element.getAttribute('data-id-question'),
            "type": "upvote",
        };
        //tạo function để gửi và xử lí dữ liệu 
        async function vote() {
            try {
                const implement = await post("../api/upvote.php", data);
                //check trạng thái của respone
                if (implement.ok) {
                    const data = await implement.json();
                    //gán nội dung của nút vote bằng giá trị repsone từ chuỗi gửi từ server 
                    element.querySelector(".upvoteValue").textContent = `${data['upvote']}`;
                } else {
                    throw new Error("Thất bại!");
                }

            } catch (error) {
                console.log(error);
            }
        }
        vote();
    });
});
//Duyệt vòng for và bắt sự kiện cho nút Downvote 
btnsDownVote.forEach(element => {
    element.addEventListener('click', () => {
        //thêm class vào nút hiện tại để thay nền 
        element.classList.toggle("active");

        //hủy class của nút DownVote nếu đã ấn 
        const btnUpDownVoteBlock = document.querySelector("#updownvote" + element.getAttribute('data-id-question'));
        const btnUpVote = btnUpDownVoteBlock.querySelector(".btnsUpVote");

        if (btnUpVote.classList.contains('active')) {
            btnUpVote.classList.remove('active');
        }
        //chuẩn bị chuỗi dữ liệu và gửi lên server 
        const data = {
            "id_question": element.getAttribute('data-id-question'),
            "type": "downvote"
        };
        //tạo function để gửi và xử lí dữ liệu 
        async function Vote() {
            const implement = await post("../api/downvote.php", data);
            try {
                //check trạng thái của respone
                if (implement.ok) {
                    const data = await implement.json();
                    //gán dữ liệu cho số lượng nút upvote
                    btnUpVote.querySelector(".upvoteValue").textContent = `${data['upvote']}`;
                } else {
                    alert("Có lỗi xảy ra x_x");
                }
            } catch (error) {
                throw new Error(error);
            }
        }

        Vote();

    });
});

//
btnsBookmark.forEach(element => {
    element.addEventListener('click', () => {
        //Chuẩn bị dữ liệu gửi lên server 
        const json = { "id_question": element.getAttribute('data-id-question') };
        //Viết hàm gửi và xử lý dữ liệu 
        async function Process() {
            const res = await post('../api/bookmark.php',json);
            if (res.ok) {
                const data = await res.json();
                try {
                    if (data["status"] === "insertedSuccessfully") {
                        if (element.getAttribute('is-clicked') == "false") {
                            element.setAttribute('is-clicked', "true");
                            element.setAttribute('src', pathIcons8 + element.getAttribute('bookmarked-state') + ".png");
                        } else {
                            element.setAttribute('is-clicked', "false");
                            element.setAttribute('src', pathIcons8 + element.getAttribute('unbookmarked-state') + ".png");
                        }
                    }
                } catch (error) {
                    console.log(err);
                    element.setAttribute('is-clicked', "false");
                    element.setAttribute('src', pathIcons8 + element.getAttribute('unbookmarked-state') + ".png");

                }

            } else {

            }
        }
        Process();
    });
});

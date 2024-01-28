/*-----------------------------------------------------------------------------------*/
/*  START
/*-----------------------------------------------------------------------------------*/
document.readyState !== "loading"
    ? startJs()
    : document.addEventListener("DOMContentLoaded", () =>
          setTimeout(startJs(), 3000)
      );
function startJs() {
    console.log("STARTING 1");
    //check if class list of task exists
    if (document.querySelector(".list-of-task")) {
        //get all task
        let tasks = document.querySelectorAll(".todoCheck");
        console.log(tasks, "tasks");
        //loop through each task
        tasks.forEach((task) => {
            //add event listener to delete button
            task.addEventListener("click", () => {
                //get the id of the task
                let id = task.getAttribute("data-id");
                console.log(id, "id...");

                fetch(`/update/${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(
                                `HTTP error! Status: ${response.status}`
                            );
                        }
                        return response.json(); // or response.text() if the response is not in JSON format
                    })
                    .then((data) => {
                        // Handle the data returned by the server
                        console.log(data);
                    })
                    .catch((error) => {
                        // Handle errors
                        console.error("Error:", error);
                    });
            });
        });
    }
}

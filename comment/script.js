document.getElementById('comment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value;
    const commentText = document.getElementById('comment').value;
    const commentsList = document.getElementById('comments-list');

   
    const newComment = document.createElement('div');
    newComment.classList.add('comment');
    newComment.innerHTML = `<p><strong>${name}:</strong> ${commentText}</p>`;
    
  
    commentsList.appendChild(newComment);
    
    
    document.getElementById('name').value = ''; 
    document.getElementById('comment').value = ''; 
});

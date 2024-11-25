var grid_items = document.getElementsByClassName("grid-item");

for (let i = 0; i < grid_items.length; i++) {
    const picture = grid_items[i];

    picture.ondblclick = function() {
        
        
        if (picture.querySelector(".image-label")) {
            picture.removeChild(picture.lastChild);
        }

        else {
            var label = document.createElement('div');
            label.classList.add('image-label');

            var icon = document.createElement('i');
            icon.classList.add('bi', 'bi-heart-fill');
            icon.style = "color:#DE3163;"

            label.appendChild(icon);
            picture.appendChild(label);
        }
    };
}
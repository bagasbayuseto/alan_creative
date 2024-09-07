<script>
    let itemCount = 1;

    function addPesan() {
        const container = document.getElementById('pesan-container');
        const newItem = document.createElement('div');
        newItem.classList.add('pesan-item', 'form-row', 'mb-3', 'align-items-end');
        newItem.innerHTML = `
        <div class="col-md-6">
            <label for="id_menu_${itemCount}">Menu:</label>
            <select name="pesans[${itemCount}][id_menu]" id="id_menu_${itemCount}" class="form-control" required onchange="updatePrice(${itemCount})">
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}" data-price="{{ $menu->harga }}">
                        {{ $menu->nama_menu }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="quantity_${itemCount}">Quantity:</label>
            <div class="input-group">
                <input type="number" name="pesans[${itemCount}][quantity]" id="quantity_${itemCount}" class="form-control" min="1" required oninput="updatePrice(${itemCount})">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="removePesan(${itemCount})"><i
        class="fas fa-window-close"></i></button>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="total_price_${itemCount}">Rp. 0.00</span>
                </div>
            </div>
        </div>
    `;
        container.appendChild(newItem);
        itemCount++;
    }

    function removePesan(index) {
        const items = document.querySelectorAll('.pesan-item');
        if (items[index]) {
            items[index].remove();
            updateTotal(); // Update total setelah menghapus item
        }
    }

    function updatePrice(index) {
        const selectMenu = document.getElementById(`id_menu_${index}`);
        const quantityInput = document.getElementById(`quantity_${index}`);
        const totalPriceSpan = document.getElementById(`total_price_${index}`);

        const selectedOption = selectMenu.options[selectMenu.selectedIndex];
        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const quantity = parseInt(quantityInput.value) || 0;

        const totalPrice = price * quantity;
        totalPriceSpan.textContent = `Rp. ${totalPrice.toFixed(2)}`;

        updateTotal(); // Update total setiap kali harga item diubah
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.pesan-item').forEach(item => {
            const totalPriceSpan = item.querySelector('.input-group-text');
            const totalPrice = parseFloat(totalPriceSpan.textContent.replace('Rp. ', '').replace(',', '.')) ||
                0;
            total += totalPrice;
        });
        document.getElementById('total_amount').textContent = `Rp. ${total.toFixed(2)}`;
    }
</script>

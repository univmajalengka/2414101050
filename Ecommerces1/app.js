const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "HEDONIST",
    price: 99,
    colors: [
      {
        code: "black",
        img: "./pict project e/HEDONIST.png",
      },
      {
        code: "darkblue",
        img: "",
      },
    ],
  },
  {
    id: 2,
    title: "STARBBOY",
    price: 99,
    colors: [
      {
        code: "lightgray",
        img: "./pict project e/STARBOY.png",
      },
      {
        code: "green",
        img: "",
      },
    ],
  },
  {
    id: 3,
    title: "BRUCE",
    price: 99,
    colors: [
      {
        code: "lightgray",
        img: "./pict project e/BRUCE.png",
      },
      {
        code: "green",
        img: "",
      },
    ],
  },
  {
    id: 4,
    title: "ROUGE",
    price: 99,
    colors: [
      {
        code: "black",
        img: "./pict project e/ROUGE.png",
      },
      {
        code: "lightgray",
        img: "",
      },
    ],
  },
  {
    id: 5,
    title: "Grey",
    price: 99,
    colors: [
      {
        code: "gray",
        img: "./pict project e/GREY.png",
      },
      {
        code: "black",
        img: "./img/hippie2.png",
      },
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductSizes = document.querySelectorAll(".size");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    //change the current slide
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    //change the choosen product
    choosenProduct = products[index];

    //change texts of currentProduct
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "$" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;

    //assing new colors
    currentProductColors.forEach((color, index) => {
      color.style.backgroundColor = choosenProduct.colors[index].code;
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    currentProductImg.src = choosenProduct.colors[index].img;
  });
});

currentProductSizes.forEach((size, index) => {
  size.addEventListener("click", () => {
    currentProductSizes.forEach((size) => {
      size.style.backgroundColor = "white";
      size.style.color = "black";
    });
    size.style.backgroundColor = "black";
    size.style.color = "white";
  });
});

const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});

// Receipt / Struk handling
const payButton = document.querySelector('.payButton');
const receiptEl = document.getElementById('receipt');
const printBtn = document.getElementById('printReceipt');
const closeReceiptBtn = document.getElementById('closeReceipt');

function formatDate(d){
  const dd = String(d.getDate()).padStart(2,'0');
  const mm = String(d.getMonth()+1).padStart(2,'0');
  const yyyy = d.getFullYear();
  const hh = String(d.getHours()).padStart(2,'0');
  const min = String(d.getMinutes()).padStart(2,'0');
  return `${dd}-${mm}-${yyyy} ${hh}:${min}`;
}

function genOrderId(){
  return 'RZ' + Date.now().toString().slice(-8);
}

payButton.addEventListener('click', (e) => {
  // prevent default form submit if any
  e.preventDefault();
  // gather inputs
  const name = document.getElementById('payName').value || 'Customer';
  const phone = document.getElementById('payPhone').value || '-';
  const address = document.getElementById('payAddress').value || '-';

  // fill receipt
  document.getElementById('receiptOrderId').textContent = genOrderId();
  document.getElementById('receiptDate').textContent = formatDate(new Date());
  document.getElementById('receiptCustomerName').textContent = name;
  document.getElementById('receiptPhone').textContent = phone;
  document.getElementById('receiptAddress').textContent = address;
  document.getElementById('receiptProduct').textContent = choosenProduct.title;
  document.getElementById('receiptPrice').textContent = 'Rp ' + choosenProduct.price + '.000';

  // hide payment form and show receipt
  payment.style.display = 'none';
  receiptEl.style.display = 'block';
});

printBtn.addEventListener('click', () => {
  // open a print window containing only the receipt
  const printContents = receiptEl.innerHTML;
  const originalContents = document.body.innerHTML;
  const printWindow = window.open('', '', 'width=600,height=800');
  if(!printWindow) {
    alert('Pop-up blocker mencegah pencetakan. Izinkan pop-up untuk situs ini.');
    return;
  }
  printWindow.document.write(`<!doctype html><html><head><title>Struk Pembayaran</title><link rel="stylesheet" href="style.css"></head><body>${printContents}</body></html>`);
  printWindow.document.close();
  printWindow.focus();
  // wait for styles to load then print
  setTimeout(() => {
    printWindow.print();
    printWindow.close();
  }, 500);
});

closeReceiptBtn.addEventListener('click', () => {
  receiptEl.style.display = 'none';
});

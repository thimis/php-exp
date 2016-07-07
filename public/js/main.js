const filterProto = {
  methods: {
    init: function() {
      filterProto.el.image = document.getElementById('image');
      filterProto.el.container = document.getElementById('filters');
      filterProto.el.filterList = filterProto.el.container.querySelectorAll('.button');

      if (filterProto.el.image.className.length > 0) {
        filterProto.methods.setActive(filterProto.el.image.className);
      }

      // add event listeners
      for (i = 0; i < filterProto.el.filterList.length; i++) {
        filterProto.el.filterList[i].addEventListener('click', function() {
          filterProto.methods.handleClick(this);
        });
      }
    },
    setFilter: function(el) {
      var filter = el.getAttribute('data-filter');
      filterProto.el.image.className = filter;
    },
    handleClick: function(el) {
      currentBtn = filterProto.el.container.querySelector('.active');
      currentBtn.className = 'button button-outline';
      el.className = 'button active';
      filterProto.methods.setFilter(el);
    },
    setActive: function(className) {
      for (var i = 0; i < filterProto.el.filterList.length; i++) {
        if (className === filterProto.el.filterList[i].getAttribute('data-filter')) {
          filterProto.el.filterList[i].className = 'button active';
        }
      }
    },
  },
  el: {
    image: null,
    container: null,
  },
};

if (document.getElementById('filters')) {
  filterProto.methods.init();
} else {
  console.log('not image page');
}

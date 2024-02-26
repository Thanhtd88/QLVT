import Autocomplete from "https://cdn.jsdelivr.net/gh/lekoala/bootstrap5-autocomplete@master/autocomplete.js";
  const opts = {
    onSelectItem: console.log,
  };
  var src = [];
  // We can use regular objects as source and customize label
  new Autocomplete(document.getElementById("autocompleteRegularInput"), {
    items: {
      opt_some: "Some",
      opt_value: "Value",
      opt_here: "Here is a very long element that should be truncated",
      opt_dia: "çaça"
    },
    onRenderItem: (item, label) => {
      return label + " (" + item.value + ")";
    },
  });
  new Autocomplete(document.getElementById("autocompleteDatalist"), opts);
  new Autocomplete(document.getElementById("autocompleteRemote"), opts);
  new Autocomplete(document.getElementById("autocompleteLiveRemote"), opts);
# GravityForms Fix Field Names

Gravity forms automatically names the inputs that are generated on the front-end. For the most part, this is not a problem. However, buggy implementations of autofill can have incorrect data being automatically inserted into fields that are not desirable (for example, a zip code being automatically populated in a quantity input field - both 'number' values). 

### What This Plugin Does

This plugin will take the 'parameter name' attribute set on an individual Gravity Form Field and set that as the name for the input field. This will let you set things such as 'name', 'zip', 'quantity' which Google [recommends](https://developers.google.com/web/fundamentals/design-and-ux/input/forms/#recommended_input_name_and_autocomplete_attribute_values) for the best autocomplete experience.

### How to Use It

1. Open the form you wish to edit
2. Click on the field you want to have a custom name value
3. Go to the 'advanced' tab
4. Check the 'Allow field to be populated dynamically' box
5. Enter the field name you would like the input to have inside the form
6. Save the form

### Limitations

Currently, the plugin only supports the below fields. This is due to the complexity of the field generation and not wanting to muck with HTML output / validation of checkboxes, selects or any other advanced field type.

- Text
- Phone
- Number
- Email
- Textarea
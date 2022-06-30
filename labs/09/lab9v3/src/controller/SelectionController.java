package controller;

import view.SelectionView;
import model.SelectionModel;

public class SelectionController {
    private final SelectionModel model;
    private final SelectionView view;

    public SelectionController(SelectionModel model, SelectionView view) {
        this.model = model;
        this.view = view;
    }
}

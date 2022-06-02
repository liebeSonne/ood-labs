package controller;

import document.DocumentInterface;
import view.ShapeDataViewInterface;

import java.awt.*;

public class MenuController extends ShapeController {

    public MenuController(DocumentInterface document, ShapeDataViewInterface view) {
        super(document, view);
    }

    public void onExit() {
        System.out.println("onExit");
        System.exit(0);
    }
}

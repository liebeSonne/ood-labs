package view.form;

import controller.CanvasController;
import model.Document;
import view.data.ShapeDataViewInterface;

import javax.swing.*;
import java.awt.*;

public class CanvasView extends JPanel implements ShapeDataViewInterface {
    private Document document;
    private CanvasController controller;
    public CanvasView(Document document) {
        super();
        this.document = document;
        this.controller = new CanvasController(document);
    }

    @Override
    public Point getCenter() {
        return new Point(this.getWidth() /2, this.getHeight() / 2);
    }
}

package view;

import canvas.GraphicsCanvas;
import document.DocumentInterface;

import javax.swing.*;
import java.awt.*;

public class CanvasPanel extends JPanel {
    private DocumentInterface document;

    public CanvasPanel() {

    }

    public void setDocument(DocumentInterface document) {
        this.document = document;
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);
        Graphics2D g2 = (Graphics2D) g;

        if (this.document != null) {
            GraphicsCanvas canvas = new GraphicsCanvas(g2);
            this.document.getShapes().forEach(shape -> {
                shape.draw(canvas);
            });
        }
    }
}
